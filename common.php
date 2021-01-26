<?php
include_once "classes/Post.php";
session_start();

function upperPart(){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" media="screen" href="styles/index.css">
    <link rel="stylesheet" media="print" href="styles/print.css">
    <meta name="author" content="Sedon Attila">
    <meta name="description" content="Sedon Attila Blog">
</head>
<body>
<header>
    <div>
        <div class="marquee">
            <div>
                <div class="titleWrapper"><h1>ＶａｐｏｒＷａｖｅ　（ベーパーウェーブ）</h1></div>
                <div class="titleWrapper"><h1>ＶａｐｏｒＷａｖｅ　（ベーパーウェーブ）</h1></div>
            </div>
        </div>
    </div>

</header>
    <nav>
        <ul class="navigationBar">
            <li><a href='index.php'>Home</a></li>
            <li><a href='loginsignuplogout.php'>
                    <?php
                    if(!isset($_SESSION["user"])){
                        echo "Log in/Sign up";
                    }  else {
                        echo "Log out";
                    }  ?></a></li>
            <li><a href='newPost.php'>New Post</a></li>
            <li><a href='about.php'>About</a></li>
        </ul>
    </nav>
<section class="section">
<?php }
function lowerPart(){ ?>
</section>
<aside class="aside">
    <img src="styles/files/windows-98-CD.webp" title="the-archives-picture-top" alt="the-archives-picture-top" />
    <div class="asideContentWrapper">
        <h3>アーカイブ</h3>
        <?php
        $posts = Post::getPosts();
        foreach ($posts as $post) { ?>
    <h4 class='asidePostTitle'><a href='post.php?id=<?php echo $post->createUrlFromPost() ?>'><?php echo $post->getTitle() . ", " . $post->getAuthor() . ", " . $post->getFormattedDateToDay() . "</a></h4>";
            }
            ?>
            </div>
            <img src="styles/files/windows-95-shut-it-down.webp" title="the-archives-picture-bottom" alt="the-archives-picture-bottom" id="the-archives-picture-bottom" />
            </aside>
            <footer class="footer">
                <div class="footerContent">
                    <div>Created by Attila Sedon</div>
                    <div>Optimized for PDAs!</div>
                </div>
            </footer>
            <div id="myAudio" class="audiobox">
                <img src="styles/files/boombox-with-dolls.jpg" alt="boombox" class="audioCover" title="audiocover"/>
                <audio controls loop autoplay>
                    <source src="styles/files/MACINTOSH%20PLUS%20-%20リサフランク420%20現代のコンピュー%20(reupload).mp3">
                    Your browser does not support the audio element.
                </audio>
            </div>
</body>
</html><?php }