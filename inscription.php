<?php
include_once 'function/mise_en_page.php';
?>
<!DOCTYPE html>

<body>
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="connexion.php">Se connecter</a>
        </div>
        
    </header>
 <h1>Inscription</h1>
    
 <div id="Cforum">
    
        <form method="post" action="inscription.php">
            <p>
                <a class="w3-btna" href="inscription_client.php">client</a>
                <a class="w3-btna" href="inscription_pro.php">pro</a>
            </p>
        </form>
                
    </div>
</body>
</html>
