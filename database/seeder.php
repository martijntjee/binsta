<?php

include_once 'vendor/autoload.php';

use RedBeanPHP\R;

R::setup('mysql:host=localhost;dbname=binsta', 'root', 'root');
// clear the tables and drop foreign keys
R::nuke();

// load the seeders
require_once 'database/PostSeeder.php';
require_once 'database/UserSeeder.php';
require_once 'database/CommentSeeder.php';
require_once 'database/SnippetSeeder.php';
require_once 'database/ForkSeeder.php';

// load the seeders
$commentSeeder = new CommentSeeder();
$forkSeeder = new ForkSeeder();
$postSeeder = new PostSeeder();
$snippetSeeder = new SnippetSeeder();
$userSeeder = new UserSeeder();

$commentRecords = 0;
$forkRecords = 0;
$followerRecords = 0;
$likeRecords = 0;
$postRecords = 0;
$snippetRecords = 0;
$userRecords = 0;

foreach ($userSeeder->load() as $user) {
    $userBean = R::dispense('user');
    $userBean->username = $user['username'];
    $userBean->password = password_hash($user['password'], PASSWORD_DEFAULT);
    $userBean->email = $user['email'];
    $userBean->profile_picture = $user['profile_picture'];
    $userBean->bio = $user['bio'];
    R::store($userBean);
    $userRecords++;
}

foreach ($postSeeder->load() as $post) {
    $postBean = R::dispense('post');
    $postBean->caption = $post['caption'];
    $postBean->created_at = $post['created_at'];
    $postBean->image = $post['image'];
    $postBean->user = R::load('user', rand(1, $userRecords));
    R::store($postBean);
    $postRecords++;
}

for ($i = 0; $i < 100; $i++) {
    $likeBean = R::dispense('like');
    $likeBean->user = R::load('user', rand(1, $userRecords));
    $likeBean->post = R::load('post', rand(1, $postRecords));
    R::store($likeBean);
    $likeRecords++;
}

foreach ($commentSeeder->load() as $comment) {
    $commentBean = R::dispense('comment');
    $commentBean->text = $comment['text'];
    $commentBean->posted_on = $comment['posted_on'];
    $commentBean->user = R::load('user', rand(1, $userRecords));
    $commentBean->post = R::load('post', rand(1, $postRecords));
    R::store($commentBean);
    $commentRecords++;
}

for ($i = 0; $i < 100; $i++) {
    $followerBean = R::dispense('follower');
    $followerBean->user = R::load('user', rand(1, $userRecords));
    $followerBean->follower = R::load('user', rand(1, $userRecords));
    R::store($followerBean);
    $followerRecords++;
}

foreach ($snippetSeeder->load() as $snippet) {
    $snippetBean = R::dispense('snippet');
    $snippetBean->text = $snippet['text'];
    $snippetBean->language = $snippet['language'];
    $snippetBean->user = R::load('user', rand(1, $userRecords));
    R::store($snippetBean);
    $snippetRecords++;
}

foreach ($forkSeeder->load() as $fork) {
    $forkBean = R::dispense('fork');
    $forkBean->snippet = R::load('snippet', rand(1, $snippetRecords));
    $forkBean->user = R::load('user', rand(1, $userRecords));
    R::store($forkBean);
    $forkRecords++;
}

echo "$likeRecords likes created" . PHP_EOL;
echo "$postRecords posts created." . PHP_EOL;
echo "$userRecords users created." . PHP_EOL;
echo "$commentRecords comments created." . PHP_EOL;
echo "$followerRecords followers created." . PHP_EOL;
echo "$snippetRecords snippets created." . PHP_EOL;
echo "$forkRecords forks created." . PHP_EOL;