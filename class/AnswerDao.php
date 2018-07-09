<?php

    class AnswerDao extends Dao {

        private $result;

        public function getAnswersByMessage($message){

            $this->result = $this->data->query('SELECT t_answer_message.id AS id,
                                                    t_answer_message.answer AS answer,
                                                    t_user.name AS name,
                                                    t_user.familyname AS familyname,
                                                    t_answer_message.date AS date,
                                                    t_user.avatar AS avatar,
                                                    t_answer_message.user_id AS message_id
                                                    FROM t_answer_message INNER JOIN 
                                                    t_user ON t_answer_message.user_id = t_user.id
                                                    INNER JOIN t_message ON 
                                                    t_answer_message.message_id = t_message.id 
                                                    WHERE t_answer_message.message_id =:id
                                                    ORDER BY t_answer_message.id DESC;');
            $this->result->bindValue(':id', $message->$id, PDO::PARAM_INT);
            $this->result->execute();

            if ($this->result == false){
                return false;
            }

            $rows = array();

            while ($row = $this->result->fetch_assoc()){
                $rows[] = $row;
            }

            return $rows;

        }

        public function updateAnswer($date, $id, $value, $messageId){

            $query = $this->data->query("INSERT INTO t_answer_message(date, user_id, message_id, answer) VALUES ( :date, :id, :messageId, :value)");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':messageId', $messageId, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->bindValue(':date', $date, PDO::PARAM_STR);
            $query->execute();

        }

    }

?>