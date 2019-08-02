<head>
    <link rel="stylesheet" type="text/css" href="/src/forum/header/header.css" />
</head>

<div class="path">

    <?php //En fonction de la page du forum demandée on a pas le même chemin (normal)
    if($_GET["forum_part"] == "forums" || !isset($_GET["forum_part"])){ ?>
        <span class="index_path">INDEX > <span id="index_path_smll">Forums</span> </span>
    <?php } else if($_GET["forum_part"] == "topic"){ ?>
        <span class="index_path">INDEX > <a class="previous_page" href="/src/forum/forum.php?forum_part=forums">FORUMS</a> > LANGUAGES ><a class="previous_page" href="/src/forum/forum.php?forum_part=topics"> <?php echo $forum_name ?></a> > <span id="index_path_smll"> <?php echo $topic_title; ?> </span></span>
    <?php } else if($_GET["forum_part"] == "forum"){ ?>
        <span class="index_path">INDEX > <a id="previous_page" href="/forum.php?forum_part=forums">FORUMS</a> > <?php echo $forum_category; ?>> <span id="index_path_smll"> <?php echo $forum_name ?></span></span>
    <?php } ?>

</div>

<div id="top_nav">
  <div id="tn_groupa">

    <div class="tn_groupa_elem" <?php if($_GET["forum_part"] == "forums" || !isset($_GET["forum_part"])) {echo "style='background-color:white;'";} ?>><a href="#">Choose a forum</a></div>
    <div class="tn_groupa_elem"><a href="forum_stats.php">Stats</a></div>
    <div class="tn_groupa_elem"><a href="forum_rules.php">Rules</a></div>

  </div>

  <div id="tn_groupb">

    <form action="/search" id="searchthis" method="get">
      <input id="search" name="tn_searchbar" type="text" placeholder="Type here to search" />
      <button type=submit id="search-btn"><img id="search-icn" src=/images/icons/normal/search.svg></button>
    </form>

  </div>
</div>
