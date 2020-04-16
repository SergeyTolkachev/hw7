<?php

/**
 * Class AnyClass
 * @method findById($id)
 * @method findByEmailAndByStatus($email,$status)
 * @method findBetweenCreatedAt($dateStart,$dateEnd)
 * @method findBetweenCreatedAtAndByStatus($dateStart,$dateEnd,$status)
 * @method findBetweenCreatedAtAndInStatus($dateStart,$dateEnd, array $states)
 */
class AnyClass
{
    public static function __callStatic($name, $arguments)
    {
        $dsn = 'mysql:dbname=hw_7_Tolkachev;host=mysql';
        $user = 'root';
        $password = 'secret';
        try {
            $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Проверьте настройки подключения к базе данных:' . $e->getMessage();
        }
        switch ($name) {
            case 'findById':
                $sql = 'SELECT * FROM `test_users` WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $arguments[0]);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result != false){
                    echo 'Result of the ' . $name . ' method' ;
                    echo '<pre>';
                    var_dump($result);
                    echo '<pre><br><hr>';
                } else echo 'Nothing to show for ' . $name . 'method';
                break;
            case 'findByEmailAndByStatus':
                $sql = 'SELECT * FROM `test_users` WHERE email = :email AND status = :status';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':email', $arguments[0]);
                $stmt->bindValue(':status', $arguments[1]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($result != false){
                    echo 'Result of the ' . $name . ' method' ;
                    echo '<pre>';
                    var_dump($result);
                    echo '<pre><br><hr>';
                } else echo 'Nothing to show for ' . $name . ' method';
                break;
            case 'findBetweenCreatedAt':
                $sql = 'SELECT * FROM `test_users` WHERE created_at BETWEEN :start_date AND :end_date';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':start_date', $arguments[0]);
                $stmt->bindValue(':end_date', $arguments[1]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($result != false){
                    echo 'Result of the ' . $name . ' method';
                    echo '<pre>';
                    var_dump($result);
                    echo '<pre><br><hr>';
                } else echo 'Nothing to show for ' . $name . ' method';
                break;
            case 'findBetweenCreatedAtAndByStatus':
                $sql = 'SELECT * FROM `test_users` WHERE created_at BETWEEN :start_date AND :end_date AND status = :status';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':start_date', $arguments[0]);
                $stmt->bindValue(':end_date', $arguments[1]);
                $stmt->bindValue(':status', $arguments[2]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($result != false){
                    echo 'Result of the ' . $name . ' method';
                    echo '<pre>';
                    var_dump($result);
                    echo '<pre><br><hr>';
                } else echo 'Nothing to show for ' . $name . ' method';
                break;
            case 'findBetweenCreatedAtAndInStatus':
                $sql = 'SELECT * FROM `test_users` WHERE created_at BETWEEN :start_date AND :end_date AND status IN (:status_0, :status_1)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':start_date', $arguments[0]);
                $stmt->bindValue(':end_date', $arguments[1]);
                $stmt->bindValue(':status_0', $arguments[2][0]);
                $stmt->bindValue(':status_1', $arguments[2][1]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($result != false){
                    echo 'Result of the ' . $name . ' method';
                    echo '<pre>';
                    var_dump($result);
                    echo '<pre><br><hr>';
                    } else echo 'Nothing to show for ' . $name . ' method';
                break;
        }
    }
}
//used statuses 'coach', 'student', 'admin'
//used emails sergei.tolkachev@ukr.net, emma.wotson@gmail.com, egor.petrov@i.ua
AnyClass::findById('1');

AnyClass::findByEmailAndByStatus('sergei.tolkachev@ukr.net','student');

AnyClass::findBetweenCreatedAt('2020-04-01', '2021-05-01');

AnyClass::findBetweenCreatedAtAndByStatus('2020-04-01', '2020-05-15', 'coach');

AnyClass::findBetweenCreatedAtAndInStatus('2020-04-01', '2020-05-15', ['coach', 'student']);
