<?php
function total($pdo, $table) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM `' . $table . '`');
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0];
}

function findAll($pdo, $table) {
    $stmt = $pdo->prepare('SELECT * FROM `' . $table . '`');
    $stmt->execute();
    return $stmt->fetchAll();
}

function findById($pdo, $table, $id) {
    $stmt = $pdo->prepare('SELECT * FROM `' . $table . '` WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function insert($pdo, $table, $data) {
    $keys = implode(', ', array_keys($data));
    $values = implode(', :', array_keys($data));
    $stmt = $pdo->prepare('INSERT INTO `' . $table . '` (' . $keys . ') VALUES (:' . $values . ')');
    $stmt->execute($data);
}

function update($pdo, $table, $data, $id) {
    $fields = '';
    foreach ($data as $key => $value) {
        $fields .= $key . ' = :' . $key . ', ';
    }
    $fields = rtrim($fields, ', ');
    $stmt = $pdo->prepare('UPDATE `' . $table . '` SET ' . $fields . ' WHERE id = :id');
    $data['id'] = $id;
    $stmt->execute($data);
}

function delete($pdo, $table, $id) {
    $stmt = $pdo->prepare('DELETE FROM `' . $table . '` WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

// Special for reviews list (join tables)
function allReviews($pdo) {
    $sql = 'SELECT review.id, reviewtext, user.name AS username, film.name AS filmname, category.name AS categoryname, image
            FROM review
            INNER JOIN user ON userid = user.id
            INNER JOIN film ON filmid = film.id
            INNER JOIN category ON categoryid = category.id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}