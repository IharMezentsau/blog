<?php

    class MessageDao extends Dao {

        private $result;

        public function getMessages(){

            $this->result = $this->data->query('SELECT t_message.id AS id,
                                                t_message.message AS message, 
                                                t_user.name AS name,
                                                t_user.familyname AS familyname,
                                                t_message.date AS date,
                                                t_user.avatar AS avatar
                                                FROM t_message INNER JOIN 
                                                t_user ON t_message.user_id = t_user.id
                                                ORDER BY t_message.id DESC');

            $this->result->setFetchMode(PDO::FETCH_ASSOC);

            $rows = array();

            while ($row = $this->result->fetch()){
                $message = new Message();
                $message->id = $row['id'];
                $message->message = $row['message'];
                $message->name = $row['name'];
                $message->familyname = $row['familyname'];
                $message->date = $row['date'];
                $message->avatar = $row['avatar'];

                $rows[] = $message;
            }

            return $rows;

        }

        public function updateMessage($date, $id, $value){

            $query = $this->data->prepare("INSERT INTO t_message(date, user_id, message) VALUES ( :date, :id, :value)");
            $query->bindValue(' :id', $id, PDO::PARAM_INT);
            $query->bindValue(' :value', $value, PDO::PARAM_STR);
            $query->bindValue(' :date', $date, PDO::PARAM_STR);
            $query->execute();

        }

    }

?>