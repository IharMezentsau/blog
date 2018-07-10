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

            return $like;
        }

        public function insertLike($id, $user_id){

            $query = $this->data->prepare("INSERT INTO t_like(message_id, user_id) VALUES (:id, :user_id)");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();

        }

        public function deleteLike($id, $user_id){

            $query = $this->data->prepare("DELETE FROM t_like WHERE user_id= :user_id AND message_id= :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();

        }

        public function getWhoLikeByMessageByUser($messageId, $userId){

            $this->result = $this->data->prepare('SELECT COUNT(id) AS count FROM t_like WHERE user_id=:userId AND message_id=:messageId LIMIT 1;');

            $this->result->bindValue(':userId', $userId, PDO::PARAM_INT);
            $this->result->bindValue(':messageId', $messageId, PDO::PARAM_INT);

            $this->result->execute();

            $row = $this->result->fetch();

            $like = new Like();

            $like->likeByUser = $row['count'];

            return $like;

        }

    };

?>