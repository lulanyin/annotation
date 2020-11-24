<?php
namespace Inphp\Annotation\Processor;

use Doctrine\Common\Annotations\Annotation\Target;
use Inphp\Annotation\IAnnotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 * Class Inject
 * @package Inphp\annotation\parser
 */
class Inject implements IAnnotation
{

    /**
     * 注入的类名
     * @var mixed|string
     */
    public $name = '';

    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->name = $values['value'];
        }
        if (isset($values['name'])) {
            $this->name = $values['name'];
        }
    }

    /**
     * 获取注入的类名
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 实现
     * @param $class
     * @param string|null $target
     * @param string|null $targetType
     * @return mixed|void
     */
    public function process($class, string $target = null, string $targetType = null)
    {
        // TODO: Implement process() method.
        if(class_exists($this->name)){
            $targetClass = new $this->name();
            if(method_exists($targetClass, "Inject")){
                $targetClass->Inject($class, $target, $targetType);
            }
        }
    }
}