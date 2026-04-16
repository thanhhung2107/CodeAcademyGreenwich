<?php
function query($pdo, $sql, $parameters = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);
    return $stmt;
}

/* FILM FUNCTIONS */
function allFilms($pdo) {
    return query($pdo, 'SELECT id, name, created_at FROM film ORDER BY created_at DESC')->fetchAll();
}

function getFilm($pdo, $id) {
    return query($pdo, 'SELECT * FROM film WHERE id = :id', ['id' => $id])->fetch();
}
function insertFilm($pdo, $name) {
    query($pdo, 'INSERT INTO film (name) VALUES (:name)', ['name' => $name]);
}
function updateFilm($pdo, $id, $name) {
    query($pdo, 'UPDATE film SET name = :name WHERE id = :id', ['name' => $name, 'id' => $id]);
}
function deleteFilm($pdo, $id) {  // ← đã sửa đơn giản
    query($pdo, 'DELETE FROM film WHERE id = :id', ['id' => $id]);
}

/* USER FUNCTIONS */
function allUsers($pdo) {
    return query($pdo, 'SELECT id, name, email, registerdate FROM users ORDER BY registerdate DESC')->fetchAll();
}

function getUser($pdo, $id) {
    return query($pdo, 'SELECT * FROM users WHERE id = :id', ['id' => $id])->fetch();
}
function insertUser($pdo, $name, $email) {
    query($pdo, 'INSERT INTO users (name, email) VALUES (:name, :email)', ['name' => $name, 'email' => $email]);
}
function updateUser($pdo, $id, $name, $email) {
    query($pdo, 'UPDATE users SET name = :name, email = :email WHERE id = :id', ['name' => $name, 'email' => $email, 'id' => $id]);
}
function deleteUser($pdo, $id) {
    query($pdo, 'DELETE FROM users WHERE id = :id', ['id' => $id]);
}

function allReviews($pdo) {
    // Thêm u.name AS username và f.name AS filmname vào dòng SELECT
    $sql = 'SELECT r.*, u.name AS username, f.name AS filmname 
            FROM review r 
            JOIN users u ON r.userid = u.id 
            JOIN film f ON r.filmid = f.id 
            ORDER BY r.reviewdate DESC';
            
    return query($pdo, $sql)->fetchAll();
}

function getReview($pdo, $id) {
    return query($pdo, 'SELECT * FROM review WHERE id = :id', ['id' => $id])->fetch();
}

function insertReview($pdo, $reviewtext, $image, $userid, $filmid) {
    query($pdo, 'INSERT INTO review (reviewtext, image, userid, filmid) 
                 VALUES (:reviewtext, :image, :userid, :filmid)', [
        'reviewtext' => $reviewtext,
        'image'      => $image,
        'userid'     => $userid,
        'filmid'     => $filmid
    ]);
}

function updateReview($pdo, $id, $reviewtext, $image, $userid, $filmid) {
    query($pdo, 'UPDATE review SET reviewtext = :reviewtext, image = :image, userid = :userid, filmid = :filmid WHERE id = :id', [
        'reviewtext' => $reviewtext,
        'image'      => $image,
        'userid'     => $userid,
        'filmid'     => $filmid,
        'id'         => $id
    ]);
}

function deleteReview($pdo, $id) {   // ← đã sửa đơn giản
    query($pdo, 'DELETE FROM review WHERE id = :id', ['id' => $id]);
}

/* CONTACT FUNCTIONS */
function allContacts($pdo) {
    return query($pdo, 'SELECT id, email, message FROM contact ORDER BY id DESC')->fetchAll();
}

function deleteContact($pdo, $id) {
    query($pdo, 'DELETE FROM contact WHERE id = :id', ['id' => $id]);
}
?>