 ╔══════════════════════════════════════════════════════════════════════════════╗
 ║                                                                              ║
 ║   ███████╗██╗  ██╗██╗██╗     ██╗     ███████╗██╗    ██╗██╗██████╗ ███████╗   ║
 ║   ██╔════╝██║ ██╔╝██║██║     ██║     ██╔════╝██║    ██║██║██╔══██╗██╔════╝   ║
 ║   ███████╗█████╔╝ ██║██║     ██║     ███████╗██║ █╗ ██║██║██████╔╝█████╗     ║
 ║   ╚════██║██╔═██╗ ██║██║     ██║     ╚════██║██║███╗██║██║██╔═══╝ ██╔══╝     ║
 ║   ███████║██║  ██╗██║███████╗███████╗███████║╚███╔███╔╝██║██║     ███████╗   ║
 ║   ╚══════╝╚═╝  ╚═╝╚═╝╚══════╝╚══════╝╚══════╝ ╚══╝╚══╝ ╚═╝╚═╝     ╚══════╝   ║
 ║                                                                              ║
 ╚══════════════════════════════════════════════════════════════════════════════╝


        ╔═══════════════════════════════════════════════════════════╗
        ║   ██╗   ██╗    ██╗     ██╗     ██████╗ ██╗  ██╗ ██████╗   ║
        ║   ██║   ██║   ███║    ███║     ╚════██╗██║  ██║██╔════╝   ║
        ║   ██║   ██║   ╚██║    ╚██║      █████╔╝███████║███████╗   ║
        ║   ╚██╗ ██╔╝    ██║     ██║      ╚═══██╗╚════██║██╔═══██╗  ║
        ║    ╚████╔╝ ██╗ ██║ ██╗ ██║ ██╗ ██████╔╝     ██║╚██████╔╝  ║
        ║     ╚═══╝  ╚═╝ ╚═╝ ╚═╝ ╚═╝ ╚═╝ ╚═════╝      ╚═╝ ╚═════╝   ║
        ╚═══════════════════════════════════════════════════════════╝

                        ╔═════════════════════════════╗     
                        ║   ARBORESCENCES DU PROJET   ║     
                        ╚═════════════════════════════╝      

SkillSwipe/
├── index.php
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── favicon.ico
│   ├── css/
│   │   ├── style.css
│   │   ├── explore_user.css
│   │   ├── swipe_user.css
│   │   ├── swipe_student.css
│   │   ├── forms.css
│   │   ├── index.css
│   │   ├── messagerie.css
│   │   └── static.css
│   ├── js/
│   │   ├── api.js
│   │   ├── explore_user.js
│   │   ├── swipe_user.js
│   │   ├── swipe_recruiter.js
│   │   └── swipe.js
│   ├── api/
│   │   ├── get_swipe_data.php
│   │   ├── get_swipe_user_data.php
│   │   ├── get_recruiter_data.php
│   │   ├── explorer_recruiter.php
│   │   ├── match_recruiter.php
│   │   ├── match.php
│   │   ├── gif-search-tenor.js
│   │   ├── leaflet-geocoder-ban.js
│   │   └── leaflet-geocoder-ban.min.css
│   ├── images/
│   │   └── bouygues.png
│   └── views/
│       └── swipe_view/
│           ├── swipe.php
│           ├── explore_user.php
│           └── swipe_recruiter.php
├── bdd/
│   ├── createdatabase.sql
│   ├── seed_vectors.sql
│   └── changes/
│       └── skillswipe_matching.sql
├── config/
│   └── database.php
├── controllers/
│   ├── userController.php
│   ├── offerController.php
│   ├── eventController.php
│   ├── adminController.php
│   ├── swipeController.php
│   ├── exploreUserController.php
│   └── swipeUserController.php
├── models/
│   ├── userModel.php
│   ├── offerModel.php
│   ├── eventModel.php
│   ├── adminModel.php
│   ├── vectorModel.php
│   └── exploreUserModel.php
├── library/
│   └── vector_tools.php
└── views/
    ├── layout/
    │   ├── header.php
    │   └── footer.php
    ├── user/
    ├── offer/
    ├── event/
    ├── admin/
    └── swipe/
        └── swipe.php


                        ╔═════════════════════════════╗     
                        ║    INFORMATIONS DIVERSES    ║     
                        ╚═════════════════════════════╝      

                    ★░░░░░░░░░░░████░░░░░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░███░██░░░░░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░██░░░█░░░░░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░██░░░██░░░░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░░██░░░███░░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░░░██░░░░██░░░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░░░██░░░░░███░░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░░░░██░░░░░░██░░░░░░░░░░░░░★ 
                    ★░░░░░░░███████░░░░░░░██░░░░░░░░░░░░★ 
                    ★░░░░█████░░░░░░░░░░░░░░███░██░░░░░░★ 
                    ★░░░██░░░░░████░░░░░░░░░░██████░░░░░★ 
                    ★░░░██░░████░░███░░░░░░░░░░░░░██░░░░★ 
                    ★░░░██░░░░░░░░███░░░░░░░░░░░░░██░░░░★ 
                    ★░░░░██████████░███░░░░░░░░░░░██░░░░★ 
                    ★░░░░██░░░░░░░░████░░░░░░░░░░░██░░░░★ 
                    ★░░░░███████████░░██░░░░░░░░░░██░░░░★ 
                    ★░░░░░░██░░░░░░░████░░░░░██████░░░░░★ 
                    ★░░░░░░██████████░██░░░░███░██░░░░░░★ 
                    ★░░░░░░░░░██░░░░░████░███░░░░░░░░░░░★ 
                    ★░░░░░░░░░█████████████░░░░░░░░░░░░░★ 
                    ★░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░★
                        

Composition du projet (compté à la main le 21/05/25 at 1am) :

═════════════════════════════════════════════════════════════════════════

POURCENTAGE PAR NOMBRE DE FICHIERS :

- PHP : 40.35%
- JS : 10.53%
- CSS : 10.53%
- SQL : 14.04%
- HACK (Mélange du langage PHP ET HTML) : 24.56%

AU TOTAL : 57 FICHIERS DANS LE PROJET ACTUEL, 8 SQL, 23 PHP, 14 HACK, 6 CSS, 6 JS.

═════════════════════════════════════════════════════════════════════════

POURCENTAGE PAR NOMBRE DE LIGNES DE CODE :

- PHP : 22.05%
- JS : 13.74%
- CSS : 23.34%
- SQL : 24.42%
- HACK (Mélange du langage PHP ET HTML) : 16.45%

AU TOTAL : 4164 LIGNES DE CODE DANS LE PROJET ACTUEL, 1017 LIGNES DE SQL, 972 LIGNES DE CSS, 572 LIGNES DE JS, 685 LIGNES DE HACK, 918 LIGNES DE PHP.



══════════════════════════════════════════════════════════════ UPDATE ══════════════════════════════════════════════════════════════


Composition du projet actuelle (compté à la main le 10/07/25 at 2am) :

-------------------------------------------------------------------------------                                         
Language                     files          blank        comment           code                                         
-------------------------------------------------------------------------------                                         
PHP                            267          50574          46178          72024                                         
CSS                             22            651            149           3814                                         
Markdown                        13            393              0           1901                                         
SQL                              9             88             56            726                                         
JavaScript                      11            138             14            665                                         
YAML                             6             42             54            258                                         
SVG                              1              0              0            209                                         
JSON                             3              0              0            185                                         
Text                             2             30              0            153                                         
Bourne Shell                     4             27             18            120                                         
XML                              3              5              1             92                                         
HTML                             2              0              0             40                                         
INI                              1              3              0             12                                         
Dockerfile                       1              5              1              9                                         
-------------------------------------------------------------------------------                                         
SUM:                           345          51956          46471          80208                                         
-------------------------------------------------------------------------------  
