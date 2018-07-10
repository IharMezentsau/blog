<?php

    class MessageDao extends Dao {

        private $result;

        public function getMessages($numpost, $viewMessage){

            $this->result = $this->data->prepare('SELECT t_message.id AS id,
                                                t_message.message AS message, 
                                                t_user.name AS name,
                                                t_user.familyname AS familyname,
                                                t_message.date AS date,
                                                t_user.avatar AS avatar
                                                FROM t_message INNER JOIN 
                                                t_user ON t_message.user_id = t_user.id
                                                ORDER BY t_message.id DESC
                                                LIMIT :numpost, :viewMessage');

            $this->result->bindValue(':numpost', $numpost, PDO::PARAM_INT);
            $this->result->bindValue(':viewMessage', $viewMessage, PDO::PARAM_INT);

            $this->result->execute();

            $rows = array();

            while ($row = $this->result->fetch(PDO::FETCH_ASSOC)){
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

        public function getCountMessage(){

            $this->result = $this->data->prepare('SELECT COUNT(id) AS count FROM t_message');

            $this->result->execute();

            $row = $this->result->fetch();

            $countMessage = new Message();

            $countMessage->countMessage = $row['count'];

            return $countMessage;

        }

        public function newMessage($date, $id, $value){

            $query = $this->data->prepare("INSERT INTO t_message(date, user_id, message) VALUES ( :date, :id, :value)");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->bindValue(':date', $date, PDO::PARAM_STR);
            $query->execute();

        }

    }

?>