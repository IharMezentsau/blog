<?php

    class UserDao extends Dao {

        private $result;

        public function getById($id){

            $this->result = $this->data->query('SELECT id, email, name, familyname, 
                                            sex, avatar 
                                      FROM t_user 
                                      WHERE id=:id');
            $this->result->bindValue(':id', $id, PDO::PARAM_INT);
            $this->result->execute();


            if ($this->result == false){
                return false;
            }

            $row = $this->result->fetch_assoc();

            return $row;

        }

        public function updateName($id, $value){

            $query = $this->data->$query("UPDATE t_user SET
                                                name=:value
                                                WHERE id=:id
                                                LIMIT 1");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->execute();

        }

        public function updateFamilyname($id, $value){

            $query =  $this->data->$query("UPDATE t_user SET
                                                familyname=:value
                                                WHERE id=:id
                                                LIMIT 1");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->execute();

        }

        public function updateGender($id, $value){

            $query = $this->data->$query("UPDATE t_user SET
                                                sex=:value
                                                WHERE id=:id
                                                LIMIT 1");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->execute();

        }

        public function updateAvatar($id, $value){

            $query = $this->data->$query("SELECT avatar,sex FROM t_user
                                          WHERE id=:id LIMIT 1");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            while ($row = $query->fetch_assoc()){
                if ($row['avatar'] != NULL) {
                    unlink($row['avatar']);
                }
                else{
                    switch ($row['sex']){
                        case 'M':
                            $value = 'img/male.jpg';
                            break;
                        case 'F':
                            $value = 'img/female.jpg';
                            break;
                        case 'U':
                            $value = 'img/unknow.jpg';
                            break;
                    }
                }
            }

            $query = $this->data->query("UPDATE t_user SET
                                                avatar=:value
                                                WHERE id=:id
                                                LIMIT 1");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->execute();

        }

        public function autorisation($login, $password){

            $this->result = $this->data->query('SELECT id FROM t_user WHERE email=:login AND password=:password LIMIT 1');
            $this->result->bindValue(':login', $login, PDO::PARAM_STR);
            $this->result->bindValue(':login', $login, PDO::PARAM_STR);
            $this->result->execute();


            if ($this->result == false){
                return null;
            }

            $row = $this->result->fetch_assoc();

            return $row;

        }

    };

?>