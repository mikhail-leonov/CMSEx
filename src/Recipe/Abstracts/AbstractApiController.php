<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Abstracts;

use \Klein\DataCollection\DataCollection;
use \Recipe\Abstracts\AbstractController;
use \Recipe\Factories\DecoratorFactory;
use \Recipe\Factories\ModelFactory;

/**
 * Class Abstract API Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class AbstractApiController extends AbstractController
{
    /**
     * MergedRequestParams - Returns merged request params and named values 
     * 
     * @var stdClass $result Response result
     * @var DataCollection $params request typed parameters
     * @return string Decorated response result
     */
    public function DecorateResponse(\stdClass $result, DataCollection $params) : string {
        $decoratorName = $params->get('format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        return $decorator->Decorate($result);
    }
    /**
     * actionEntity
     * 
     * @var DataCollection $params Request parameters merged with named parameters
     * @var string $modelName Model Name
     * @var string $methodName Function Name to call
     * @return string Rendered response
     */
    public function actionEntity(DataCollection $params, string $modelName, string $methodName) : string {
        $tagModel = ModelFactory::build($modelName);
        $result = $tagModel->$methodName($params);
        return $this->DecorateResponse($result, $params);
    }

}