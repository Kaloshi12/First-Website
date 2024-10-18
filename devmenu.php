
<?php 
require_once "check_session.php";
//checkAccessLevel("developer");
if (isset($_SESSION["username"]) && isset($_SESSION["access_level"])) {
    if ($_SESSION["access_level"] == "developer") {
        require_once "headerDev.php";
    }  elseif ($_SESSION["access_level"] == "owner") {
        require_once "headerOwner.php";
    }
}else{
    header("LOcation: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<style>
         @property --gradient-angle {
            syntax: "<angle>";
            initial-value: 0deg;
            inherits: false;
        }

        @keyframes rotation {
    0% { --gradient-angle: 0deg; }
    10% { --gradient-angle: 45deg; }
    20% { --gradient-angle: 90deg; }
    30% { --gradient-angle: 135deg; }
    40% { --gradient-angle: 180deg; }
    50% { --gradient-angle: 225deg; }
    60% { --gradient-angle: 270deg; }
    70% { --gradient-angle: 315deg; }
    80% { --gradient-angle: 360deg; }
    90% { --gradient-angle: 405deg; }
    100% { --gradient-angle: 450deg; } 
}

        :root {
            --crl-1: #999900;
            --crl-2: #cccc00;
            --crl-3: #ffff00;
            --crl-4: #cc9900;
            --crl-5: #996600;
        }

        body {
            
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
        }
        .container {
            margin-top: 80px;
            margin-left: 100px;
            margin-right: 100px;
            height: 500px;
            position: relative;
            backdrop-filter: blur(20px);
            justify-content: center;
            align-items: center;
            border: 2px solid rgba(255, 255, 255, .2);
            box-shadow:0 0 20px rgba(0, 0, 0,.2) ;
            border-radius: 0.5rem;
            background: var(--crl-1);
            border-radius: inherit;
            overflow:hidden;
        }
        .container::before,
        .container::after {
            content: '';
            position: absolute;
            inset: -.4rem;
            z-index: -1;
            background: linear-gradient(var(--gradient-angle), var(--crl-4), var(--crl-5), var(--crl-3),var(--crl-1));
            border-radius: inherit;
            animation: rotation 30s linear infinite;
        }


        .container::after{
            filter: blur(40rem);
        }
        .button-container {
        
            display: flex;
            margin-top: 120px;
            justify-content: center;
            align-items: center;
            gap: 50px; 
        }
        .button {
            width: 300px; 
            height: 200px;
            background: transparent;
            border: none;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: #160FB9;
        }

        #menu{
            display: block;

        }
        #menu:hover{
            border: 2px;
        }

        #news{
            display: none;
            transition: 2s ease-in-out;
            transition: 2s ease-in;
        }
        #Mod{
            display: none;
            transition: 2s ease-in-out;
            transition: 2s ease-in;
        }
        #Prog{
            display: none;
        }
      #backNews{
        width: 150px;
        height: 100px;
        border-radius: 20px;
        border: none;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 0,.2) ;;
        margin-top: 70px;
        margin-left: 550px;
        background-color: #CECECE;
        transition: 0.6s ease;
      }
      #backNews:hover{
        width: 220px;
        background-color: #B3B2B2;
      }
      #backMod{
        width: 150px;
        height: 100px;
        border-radius: 20px;
        border: none;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 0,.2) ;;
        margin-top: 40;
        margin-left: 550px;
        background-color: #CECECE;
        transition: 0.6s ease;
      }
      #backMod:hover{
        width: 220px;
        background-color: #B3B2B2;
      }
      #backProg{
        width: 150px;
        height: 100px;
        border-radius: 20px;
        border: none;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 0,.2) ;
        margin-top: 40px;
        margin-left: 550px;
        background-color: #CECECE;
        transition: 0.6s ease;
      }
      #backProg:hover{
        width: 220px;
        background-color: #B3B2B2;
      }
        
        
        .button .icon-large {
            font-size: 200px; 
             }
        .add{
            width: 300px;
            height: 200px;
            padding: 50px;
            outline: none;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            color:#3DBF0A;
            font-weight: bold;
            font-size: 250px;
        }
        .edit{
            width: 300px;
            height: 200px;
            padding: 50px;
            outline: none;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            color:#F7CB1A;
            font-weight: bold;
            font-size: 250px;
        }
        .remove{
            width: 300px;
            height: 200px;
            padding: 50px;
            outline: none;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            color:red;
            font-weight: bold;
            font-size: 250px;
        }
        .add .material-symbols-outlined,
        .edit .material-symbols-outlined,
        .remove .material-symbols-outlined {
            font-size: 200px;
        }
        
        </style>
<body>
    <div id="menu">
        <div class="container">
            <div class="button-container">
                <button id="NewsButton"  type="button" class="button">
                    <i class='bx bx-news icon-large'></i>
                </button>
            <button id="ModButton" type="button" class="button">
                    <i class='bx bxs-user icon-large'></i>
            </button>
            <button id="ProgramButton" type="button" class="button">
                    <i class='bx bx-show-alt icon-large'></i>
            </button>
        </div>
    </div>
    </div>

    <div id="news">
        <div class="container">
            <div class="button-container">
            <button id="AddArticle" type="button" class="add" onclick="location.href='addArticle.php';">
    <span class="material-symbols-outlined">add</span>
</button>

                <button id="EditArticle" type="button" class="edit"  onclick="location.href='editArticle.php';">
                    <span class="material-symbols-outlined">edit</span>
                </button>

                <button id="RemoveArticle" type="button" class="remove"  onclick="location.href='removeArticle.php';">
                    <span class="material-symbols-outlined">delete</span>
                </button>
                
            </div>
            <div>
                <button id="backNews" type="button"><span class="material-symbols-outlined">arrow_back</span></button>
            </div>
        </div>
    </div>
    <div id="Mod">
        <div class="container">
            <div class="button-container">
            <button id="AddMod" type="button" class="add"  onclick="location.href='addModerator.php';">
                    <span class="material-symbols-outlined">add</span>
                </button>
                
                <button id="EditMod" type="button" class="edit"  onclick="location.href='editModerator.php';">
                    <span class="material-symbols-outlined">edit</span>
                </button>
                
                <button id="RemoveMod" type="button" class="remove"  onclick="location.href='removeModerator.php';">
                    <span class="material-symbols-outlined">delete</span>
                </button>
               
            </div>
            <div>
                <button id="backMod" type="button"><span class="material-symbols-outlined">arrow_back</span></button>
            </div>
        </div>
    </div>
    <div id="Prog">
        <div class="container">
            <div class="button-container">
             
            <button id="AddProg" type="button" class="add"  onclick="location.href='addPrograms.php';">
                    <span class="material-symbols-outlined">add</span>
                </button>
            
                
                <button id="EditProg" type="button" class="edit"  onclick="location.href='editPrograms.php';">
                    <span class="material-symbols-outlined">edit</span>
                </button>
               
                <button id="RemoveProg" type="button" class="remove"  onclick="location.href='removeProgram.php';">
                    <span class="material-symbols-outlined">delete</span>
                </button>
               
            </div>
            <div>
                <button id="backProg" type="button"><span class="material-symbols-outlined">arrow_back</span></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
             const newsButton = document.getElementById('NewsButton');
            const modButton = document.getElementById('ModButton');
            const programButton = document.getElementById('ProgramButton');
            const menu = document.getElementById('menu');
            const divNews = document.getElementById('news');
            const divMod = document.getElementById('Mod');
           const divProg = document.getElementById('Prog');
            const backProg = document.getElementById('backProg');
        
        newsButton.addEventListener('mouseenter', function() {
        newsButton.style.width = '300px';
        newsButton.innerHTML = 'News';
        newsButton.style.fontSize = '50px';
        newsButton.style.background = 'transparent';

        document.querySelector('.menu label:nth-child(1)').style.fontSize = '24px';
    });


    newsButton.addEventListener('click', function() {
        menu.style.display ='none';
        divNews.style.display = 'block';
    });

    backNews.addEventListener('click',function(){
        menu.style.display = 'block';
        divNews.style.display = 'none';
    });
    backMod.addEventListener('click',function(){
        menu.style.display = 'block';
        divMod.style.display = 'none';
    });
    backProg.addEventListener('click',function(){
        menu.style.display = 'block';
        divProg.style.display = 'none';
    });
    modButton.addEventListener('click',function(){
        menu.style.display = 'none';
        divMod.style.display = 'block';
    });
    programButton.addEventListener('click',function(){
        menu.style.display='none';
        divProg.style.display = 'block';
    });


    newsButton.addEventListener('mouseout', function() {
        newsButton.style.width = '300px';
        newsButton.innerHTML = '<i class="bx bx-news icon-large"></i>';

        // Reset label size
        document.querySelector('.menu label:nth-child(1)').style.fontSize = '16px';
    });

    newsButton.addEventListener('click',function(){
        menu.style.display = 'none';
        divNews.style.display = 'block';
    });

    modButton.addEventListener('mouseover', function() {
        modButton.style.width = '300px';
        modButton.innerHTML = 'Moderators';
        modButton.style.fontSize='50px';
        modButton.style.background ='transparent';

        // Make label bigger
        document.querySelector('.menu label:nth-child(2)').style.fontSize = '24px';
    });

    modButton.addEventListener('mouseout', function() {
        modButton.style.width = '300px';
        modButton.innerHTML = '<i class="bx bxs-user icon-large"></i>';

        // Reset label size
        document.querySelector('.menu label:nth-child(2)').style.fontSize = '16px';
    });

    programButton.addEventListener('mouseover', function() {
        programButton.style.width = '300px';
        programButton.innerHTML = 'Programs';
        programButton.style.fontSize='50px';
        programButton.style.background ='transparent';

        document.querySelector('.menu label:nth-child(3)').style.fontSize = '24px';
    });

    programButton.addEventListener('mouseout', function() {
        programButton.style.width = '300px';
        programButton.innerHTML = '<i class="bx bx-show-alt icon-large"></i>';
        document.querySelector('.menu label:nth-child(3)').style.fontSize = '16px';
    });
});
        document.addEventListener('DOMContentLoaded', function() {
            const addNews = document.getElementById('AddArticle');
            const editNews = document.getElementById('EditArticle');
            const removeNews = document.getElementById('RemoveArticle');

            addNews.addEventListener('mouseover', function() {
                addNews.style.width = '300px';
                addNews.innerHTML = 'Add Article';
                addNews.style.fontSize='50px'
                addNews.style.background ='transparent'
                addNews.style.color ='#3DBF0A'

            });

            addNews.addEventListener('mouseout', function() {
                addNews.style.width = '300px';
                addNews.innerHTML = '<span class="material-symbols-outlined">add</span>';
            });

            editNews.addEventListener('mouseover', function() {
                editNews.style.width = '300px';
                editNews.innerHTML = 'Edit Article';
                editNews.style.fontSize='50px'
                editNews.style.background ='transparent'
                editNews.style.color= "#F7CB1A"
            });

            editNews.addEventListener('mouseout', function() {
                editNews.style.width = '300px';
                editNews.innerHTML = '<span class="material-symbols-outlined">edit</span>';
            });

            removeNews.addEventListener('mouseover', function() {
                removeNews.style.width = '300px';
                removeNews.innerHTML = 'Remove Article';
                removeNews.style.fontSize='50px'
                removeNews.style.background ='transparent'
                removeNews.style.color = 'red';
            });

            removeNews.addEventListener('mouseout', function() {
                removeNews.style.width = '300px';
                removeNews.innerHTML = '<span class="material-symbols-outlined">delete</span>';
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const addMod = document.getElementById('AddMod');
            const editMod = document.getElementById('EditMod');
            const removeMod = document.getElementById('RemoveMod');

            addMod.addEventListener('mouseover', function() {
                addMod.style.width = '300px';
                addMod.innerHTML = 'Add Moderators';
                addMod.style.fontSize='50px'
                addMod.style.background ='transparent'
                addMod.style.color ='#3DBF0A'

            });

            addMod.addEventListener('mouseout', function() {
                addMod.style.width = '300px';
                addMod.innerHTML = '<span class="material-symbols-outlined">add</span>';
            });

            editMod.addEventListener('mouseover', function() {
                editMod.style.width = '300px';
                editMod.innerHTML = 'Edit Moderators';
                editMod.style.fontSize='50px'
                editMod.style.background ='transparent'
                editMod.style.color= "#F7CB1A"
            });

            editMod.addEventListener('mouseout', function() {
                editMod.style.width = '300px';
                editMod.innerHTML = '<span class="material-symbols-outlined">edit</span>';
            });

            removeMod.addEventListener('mouseover', function() {
                removeMod.style.width = '300px';
                removeMod.innerHTML = 'Remove Moderators';
                removeMod.style.fontSize='50px'
                removeMod.style.background ='transparent'
                removeMod.style.color = 'red';
            });

            removeMod.addEventListener('mouseout', function() {
                removeMod.style.width = '300px';
                removeMod.innerHTML = '<span class="material-symbols-outlined">delete</span>';
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const addProg = document.getElementById('AddProg');
            const editProg = document.getElementById('EditProg');
            const removProg = document.getElementById('RemoveProg');

            addProg.addEventListener('mouseover', function() {
                addProg.style.width = '300px';
                addProg.innerHTML = 'Add Programs';
                addProg.style.fontSize='50px'
                addProg.style.background ='transparent'
                addProg.style.color ='#3DBF0A'

            });

            addProg.addEventListener('mouseout', function() {
                addProg.style.width = '300px';
                addProg.innerHTML = '<span class="material-symbols-outlined">add</span>';
            });

            editProg.addEventListener('mouseover', function() {
                editProg.style.width = '300px';
                editProg.innerHTML = 'Edit Programs';
                editProg.style.fontSize='50px'
                editProg.style.background ='transparent'
                editProg.style.color= "#F7CB1A"
            });

            editProg.addEventListener('mouseout', function() {
                editProg.style.width = '300px';
                editProg.innerHTML = '<span class="material-symbols-outlined">edit</span>';
            });

            removProg.addEventListener('mouseover', function() {
                removProg.style.width = '300px';
                removProg.innerHTML = 'Remove Programs';
                removProg.style.fontSize='50px'
                removProg.style.background ='transparent'
                removProg.style.color = 'red';
            });

            removProg.addEventListener('mouseout', function() {
                removProg.style.width = '300px';
                removProg.innerHTML = '<span class="material-symbols-outlined">delete</span>';
            });
        });


    </script>
</body>
</html>
