<?php

    class LikeDao extends Dao {

        public $result;

        public function getCountLikeByMessage($id){

            $this->result = $this->data->prepare('SELECT COUNT(user_id) AS countLike FROM t_like WHERE message_id=:id;');

            $this->result->bindValue(':id', $id, PDO::PARAM_INT);

            $this->result->execute();

            $row = $this->result->fetch(PDO::FETCH_ASSOC);

            $like = new Like();

            $like->countLike = $row['countLike'];


            return $row;
        }

        public function updateLike(){


        }

        public function getWhoLikeByMessageByUser($messageId, $userId){

            $this->result = $this->data->prepare('SELECT COUNT(id) AS count FROM t_like WHERE user_id=:userId AND message_id=:messageId LIMIT 1;');

            $this->result->bindValue(':userId', $userId, PDO::PARAM_INT);
            $this->result->bindValue(':messageId', $messageId, PDO::PARAM_INT);

            $this->result->execute();

            $row = $this->result->fetch();

            $like = new Like();
            $answer->avatar = $row['avatar'];

            $rows[] = $answer;
            if ($row['count'] != 1) {
                $like->likeByUser = 'likeButton btn btn-info btn-sm';
            }
            else{
                $like->likeByUser = 'likeButton btn btn-danger btn-sm';
            }

            $result = $like->likeByUser;

            return $result;

        }

    };

?>