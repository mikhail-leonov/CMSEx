<?php
/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');
require_once(EXCEPTION . 'decorator.exception.php');

/**
 * This is the "DecoratorFactory interface".
 */
interface IDecoratorFactory
{
    /**
     * Method to build an Model object of $name type IDecorator
     *
     * @var string $name Decorator name to create
     *
     * @throws Exception if the provided name does not match existing php Decorator file
     *
     * @return IDecorator Decorator we have created
     */
    public static function build(string $name) : IDecorator;
}

/**
 * This is the "Decorator factory class".
 * Extends AbstractFactory implements IDecoratorFactory
 */
class DecoratorFactory extends AbstractFactory implements IDecoratorFactory
{
    /**
     * Method to build a Decorator object of $name type IDecorator
     *
     * @var string $name Decorator name to create
     *
     * @throws DecoratorNotFoundException if the provided name does not match to any of existing php Decorator file
     *
     * @return IDecorator Decorator we have created
     */
    public static function build(string $name) : IDecorator
    {
        $decoratorName = $name . "Decorator";
        $decoratorFileName = DECORATOR . strtolower($name) . '.decorator.php';
        if (file_exists($decoratorFileName)) {
            require_once($decoratorFileName);
            return new $decoratorName();
        }
        throw new DecoratorNotFoundException($decoratorName, $decoratorFileName);
    }
}
