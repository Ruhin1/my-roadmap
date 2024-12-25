<?php 
    interface Curiyar{
        public function send($product);
    }

    class Radex implements Curiyar{
        public function send($product){
            echo "$product sending in redex. pls contact.";
        }
    }

    class Sundorban implements Curiyar{
        public function send($product){
            echo "$product sending in Sundorban. pls contact.";
        }
    }


    class CuriyarFactory{
        public static function selectCuriyar($name){
            switch ($name) {
                case 'r':
                    return new Radex();
                case 's':
                    return new Sundorban();
                default :
                    throw new Exception("Payment method not supported.");
            }
        }
        
    }

    $select = CuriyarFactory::selectCuriyar('r');
    $select->send('laptop'); 
?>