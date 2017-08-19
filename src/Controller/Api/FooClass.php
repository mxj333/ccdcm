/**
 * @author John Doe
 * @author Tomas Marny
 * @secured
 */
class FooClass {
	/** @Persistent */
	public $foo;

	/**
    * @User(loggedIn, role=Admin) 
    */
	public function bar() {}
}
