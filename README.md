# myphp
该项目主要是展示一些自己在工作中应用到的代码处理方法，包括设计模式，代码规范,架构设计


## 2 模仿java spring ,php mvc中加了一层，service ,service作各model的调用处理，c只负责if else 逻辑，通过php 魔术方法_set,_get实现参数传递
## 3 mysql分表 策略
### 场景一：订单表，用户表，商品表 分表策略
  <p> 1订单表[orderId,userId,productId,price] order_01, order_02,order_03......</p>
  <p> 2 用户_订单映射表[userId,orderId](分表产品产生业务表) user_order_01,user_order_02,user_order_03...... </p>
  <p> 3 商品_订单映射表[productId,orderId](分表产生业务表) product_id_01,product_id_02,product_id_03......</p>
<pre>产品需求
   用户订单列表查询(根据用户id取模等方式, 取出用户对应的用户_订单表所在的表)
   商品订单列表查询(根据商品id取模等方式,取出商品对应的商品_订单表所在的表)
   获取所有订单列表(union多表)  
</pre>
<p>4 id分表规则</p>
<pre>
1 方法一
"table_".id%n; //n 表数量
2 方法二
 $str = crc32($id)
 if ($str < 0) {
  return "table_".substr(abs($str),0,1)
 }
 return "table_".substr($str,0,2) 
</pre>

## 4 php 函数
### [rang](http://www.w3school.com.cn/php/func_array_range.asp) 
### [shuffle](http://www.w3school.com.cn/php/func_array_shuffle.asp)
### [str_shuffle](http://www.w3school.com.cn/php/func_string_str_shuffle.asp)
### [use 关键字用法详解](https://blog.csdn.net/wang740209668/article/details/52118289)
### [abstract](https://www.cnblogs.com/timelesszhuang/p/4720241.html)
### [clone]()
### [new static()/new self() 区别](https://www.cnblogs.com/shizqiang/p/6277091.html)
### [抽象类、接口的区别](https://blog.csdn.net/fanteathy/article/details/7309966)
### [反射](http://php.net/manual/zh/book.reflection.php)
### [反射类与实例化类的区别](https://segmentfault.com/q/1010000010809844?sort=created)


## 5 设计模式
### (一) 简单工厂模式 
#### 应用场景：在不确定有多少种操作的时候；
#### 结构: 
<pre>1个工厂；
1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；
</pre>
#### 实例代码(Src\Service\Gc)
#### 缺点：违反开放封闭原则，对扩展开发，对修改封闭

### (二) 工厂方法模式 
#### 应用场景：要实例话的对象充满不确定性可能会改变的时候；要创建的对象的数目和类型是未知的；
#### 结构: 
<pre>
1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个 interface 或者 abstract 工厂父类；
多个实现 interface 或者继承 abstract 的具体工厂类；
</pre>
#### 实例代码(Src\Service\Gcff)
#### 缺点：代码重复，单一接口实现或抽象类实现，又单独定义一个工厂，浪费


### (三) 抽象工厂模式 
#### 应用场景：要实例话的对象充满不确定性可能会改变的时候；要创建的对象的数目和类型是未知的；
#### 结构: 
<pre>
多个或1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个 interface 或者 abstract 工厂父类；
1 个实现 interface 或者继承 abstract 的具体工厂类；
</pre>
#### 实例代码(Src\Service\Cxgc)
#### 描述：工厂方法模式诞生了好多工厂，每个产品创建一个工厂，其实有些产品，完全属于一个工厂，这样抽象工厂模式较工厂方法模式就更为合理了，关键点在于，这几个产品是否同属于这个工厂，换句话说，这个工厂能否同时生产这些商品，比如鞋子和帽子，肯定是不同的工厂，运动鞋和帆布鞋是同一个工厂，只是品类不一


### (四) 使用反射优化抽象工厂模式 
#### 应用场景：要实例话的对象充满不确定性可能会改变的时候；要创建的对象的数目和类型是未知的；
#### 结构: 
<pre>
多个或1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个工厂
工厂里有多个方法，实现不同产品，具体功能
</pre>
#### 实例代码(Src\Service\reflection)->待写
####
