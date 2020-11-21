<?php
namespace Small\Annotation;

/**
 * 注解处理类的接口类，实现它即可
 * Interface IParser
 * @package Small\annotation
 */
interface IAnnotation
{
    /**
     * 统一处理入口
     * @param $class
     * @param string|null $target
     * @param string|null $targetType
     * @return mixed
     */
    public function process($class, string $target = null, string $targetType = null);
}