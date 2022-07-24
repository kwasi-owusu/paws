<?php
require_once '../../template/statics/conn/connection.php';

class Menu
{
    //create a new sales order
    public static function createMenu($table, $table_b, $table_c, $table_d, $table_e, $data){
                
        try {
            
            if($data['usr'] == 1){
                //user is a super admin
                $stmt = Connection::connect() -> prepare("SELECT *
                FROM $table
                ");

                $stmt->execute();
           
                return $stmt;
            }
            
            // $table      = 'menus';
            // $table_b    = 'sub_menu';
            // $table_c    = 'packages';  
            // $table_d    = 'user_permission_menu';
            // $table_e    = 'merchants';


            elseif($data['usr'] == 2){
                //user is a merchant admin
                $user_package = $data['pkg'];
                $stmt = Connection::connect() -> prepare("SELECT $table.*, packages.*
                FROM $table
                INNER JOIN packages ON $table.menu_ID = packages.$user_package
                ");
                
                $stmt->execute();

                return $stmt;
            }

            else{
                //user is not merchant admin but a merchant user
                $stmt = Connection::connect() -> prepare("SELECT $table.*, $table_d.*                
                FROM $table
                INNER JOIN $table_d ON $table.menu_ID = $table_d.menu_ID
                WHERE $table_d.user_ID = :uid
                ");

                $stmt->bindParam('uid', $data['uid'], PDO::PARAM_STR);
                $stmt->execute();

                return $stmt;

            }
        } catch(PDOException $e) {
            
            echo $e -> getMessage();
        }
    }

    public static function subMenu($menu_ID, $table_b, $table_d, $userRole, $user_ID){
        if($userRole == 1){
            //user is a super admin
            $stmt = Connection::connect() -> prepare("SELECT $table_b.*
                FROM $table_b 
                WHERE $table_b.menu = :md
                ");

                $stmt->bindParam('md', $menu_ID, PDO::PARAM_STR);
                
                $stmt->execute();
                
                return $stmt;

        }
        elseif($userRole == 2){
            // user is a merchant admin

            $stmt = Connection::connect() -> prepare("SELECT $table_b.*
                FROM $table_b

                WHERE $table_b.menu = :md
                ");

                $stmt->bindParam('md', $menu_ID, PDO::PARAM_STR);
                
                $stmt->execute();
                
                return $stmt;
        }
        else{
            $stmt = Connection::connect() -> prepare("SELECT $table_b.*, $table_d.*
            FROM $table_b 
            
            WHERE $table_d.menu_ID = :md
                        
            AND $table_d.user_ID = :usr
            ");

            $stmt->bindParam('md', $menu_ID, PDO::PARAM_STR);
            $stmt->bindParam('usr', $user_ID, PDO::PARAM_STR);
            
            $stmt->execute();
            
            return $stmt;
        }

    }
}