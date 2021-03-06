
/*
Tipue Search 2.0
Copyright (c) 2012 Tipue
Tipue Search is released under the MIT License
http://www.tipue.com/search
*/


var tipuesearch_stop_words = ["and", "be", "by", "do", "for", "he", "how", "if", "is", "it", "my", "not", "of", "or", "the", "to", "up", "what", "when"];

var tipuesearch_replace = {"words": [
     {"word": "tipua", replace_with: "tipue"},
     {"word": "javscript", replace_with: "javascript"}
]};

var tipuesearch_stem = {"words": [
     {"word": "e-mail", stem: "email"},
     {"word": "javascript", stem: "script"},
     {"word": "javascript", stem: "js"}
]};


/*
Include the following variable listing the pages on your site if you're using Live mode
*/


var tipuesearch_pages = ["http://www.sis.pitt.edu/~ug37/1059/FP/main.php", 
"http://www.sis.pitt.edu/~ug37/1059/FP/rank.php/?TL_ID=1",
"http://www.sis.pitt.edu/~ug37/1059/FP/rank.php/?TL_ID=2",
"http://www.sis.pitt.edu/~ug37/1059/FP/rank.php/?TL_ID=3",
"http://www.sis.pitt.edu/~ug37/1059/FP/rank.php/?TL_ID=4",
"http://www.sis.pitt.edu/~ug37/1059/FP/rank.php/?TL_ID=5", 
"http://www.sis.pitt.edu/~ug37/1059/FP/tierlist.php/?TL_ID=1",
"http://www.sis.pitt.edu/~ug37/1059/FP/tierlist.php/?TL_ID=2",
"http://www.sis.pitt.edu/~ug37/1059/FP/tierlist.php/?TL_ID=3",
"http://www.sis.pitt.edu/~ug37/1059/FP/tierlist.php/?TL_ID=4",
"http://www.sis.pitt.edu/~ug37/1059/FP/tierlist.php/?TL_ID=5",
"http://www.sis.pitt.edu/~ug37/1059/FP/images" ];
