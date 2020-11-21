<?php
namespace Small\Annotation\Processor;

use Doctrine\Common\Annotations\Annotation\Target;
use Small\Annotation\IAnnotation;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * Class After
 * @package Small\Annotation\Parser
 */
class After implements IAnnotation {

    /**
     * 处理类
     * @var array
     */
    private $class;

    /**
     * After constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        if(isset($values['value'])){
            $this->class = is_array($values['value']) ? $values['value'] : [$values['value']];
        }
    }

    /**
     * 需要数据的数据
     */
    private $result = null;

    /**
     * 设置数据
     * @param $result
     * @return After
     */
    public function setResult($result = null){
        $this->result = $result;
        return $this;
    }

    /**
     * 获取
     * @return mixed|null
     */
    public function getResult(){
        return $this->result;
    }

    /**
     * 实现注解处理
     * @param $class
     * @param string|null $target
     * @param string|null $targetType
     * @return mixed|void
     */
    public function process($class, string $target = null, string $targetType = null)
    {
        // TODO: Implement process() method.
        foreach ($this->class as $cls){
            if(class_exists($cls)){
                $obj = new $cls();
                if(method_exists($obj, "after")){
                    $this->result = $obj->after([
                        "class"     => $class,
                        "target"    => $target,
                        "targetType"=> $targetType,
                        "data"      => $this->result
                    ]);
                }
            }
        }
    }
}