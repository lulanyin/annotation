# PHP 注解实现
此组件是基于 Doctrine 的注解实现的，仅为了更快速实现自己的PHP注解

#### 安装
```
composer require inphp/annitation
```

#### 使用
```php
//先初始化
\Inphp\Annotation\Annotation::start();

//处理类的注解 $class 是已初始化的类， $method 可选，是本次类需要执行的方法
\Inphp\Annotation\Annotation::process($class, $method);

//请遵循 IAnnotation，实现 process 接口
```