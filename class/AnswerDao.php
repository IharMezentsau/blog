<?php

    class AnswerDao extends Dao {

        private $result;

        public function getAnswersByMessage($id){

            $this->result = $this->data->prepare('SELECT t_answer_message.id AS id,
                                                    t_answer_message.answer AS answer,
                                                    t_user.name AS name,
                                                    t_user.familyname AS familyname,
                                                    t_answer_message.date AS date,
                                                    t_user.avatar AS avatar,
                                                    t_answer_message.user_id AS user_id
                                                    FROM t_answer_message INNER JOIN 
                                                    t_user ON t_answer_message.user_id=t_user.id
                                                    INNER JOIN t_message ON 
                                                    t_answer_message.message_id=t_message.id 
                                                    WHERE t_answer_message.message_id=:id
                                                    ORDER BY t_answer_message.id DESC;');
            $this->result->bindValue(':id', $id, PDO::PARAM_INT);

            $this->result->execute();

            $rows = array();

            while ($row = $this->result->fetch(PDO::FETCH_ASSOC)){
                $answer = new Answer();
                $answer->id = $row['id'];
                $answer->answer = $row['answer'];
                $answer->user_id = $row['user_id'];
                $answer->name = $row['name'];
                $answer->familyname = $row['familyname'];
                $answer->date = $row['date'];
                $answer->avatar = $row['avatar'];

                $rows[] = $answer;
            }

            return $rows;

        }

        public function newAnswer($date, $id, $value, $messageId){

            $query = $this->data->prepare("INSERT INTO t_answer_message(date, user_id, message_id, answer) VALUES ( :date, :id, :messageId, :value)");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':messageId', $messageId, PDO::PARAM_INT);
            $query->bindValue(':value', $value, PDO::PARAM_STR);
            $query->bindValue(':date', $date, PDO::PARAM_STR);
            $query->execute();

        }

    }

?>