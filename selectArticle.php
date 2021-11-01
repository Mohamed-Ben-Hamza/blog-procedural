<?php


include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';



session_start();


function readMore($string,$lenght){

    if(strlen($string) > $lenght){
        $stringCut = substr($string,0,$lenght);
        $string = substr($stringCut,0, strrpos($stringCut,' ')). " ...";
       return(substr($string,0,$lenght));
    }
    return $string;
}

$sql="SELECT * from articles   INNER JOIN   categoies ON  categoies.id=articles.categories_id where publish=1 AND categoies.id=? ORDER BY date ";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);
$articles = $result1->fetchAll();

?>

<article class="artcile">   
        
<?php foreach ($articles as $article):?>                                


<div class="card">
<h2 class="Categorie"><?=$article['categorie']?></h2>
<img src="<?=$baseUrl."images/postsImages/".$article['image']?>" alt="">
<div class="container">


<h3><?=$article['titre']?></h3>
<p><?= readMore($article['description'],150) ?></p>
<div class="readMore">
    <a href="article.php?id=<?=$article[0]?>">Read More</a>
   <span><?=$article['date']?></span>
   </div> 
</div>
</div>


    
<?php endforeach ; ?>

</article>



