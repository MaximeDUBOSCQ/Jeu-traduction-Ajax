<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Traducteur</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
	<center>
		<br>
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-4">
					Saisir le thème désiré :
					<select id="listeThemes">
						<?php
						$themes = null;
						$bdd = new PDO('mysql:host=localhost;dbname=traduction', 'root', 'root')
							or die('Erreur connexion à la base de données');
						$requete = "SELECT * FROM themes;";
						$resultat = $bdd->query($requete);
						$themes = $resultat->fetchAll();
						foreach ($themes as $theme) {
						?>
							<option value="<?php echo $theme['theme']; ?>"> <?php echo $theme['theme']; ?></option>
						<?php } ?>
					</select>
					<br>
					<br>
					<!-- <label for="oui">Proposer des réponses</label>
<input type="checkbox" id="oui"> -->
					<br><br>
					Nombre d'essais possibles (1 si plusieurs propositions):
					<br>
					<input type="number" name="number" id="number" value="1">
					<br><br>
					<input type="button" id="btnValider" value="Valider" class="btn btn-dark">
				</div>
				<div class="col-12 col-md-4">
					Mot à traduire :
					<br>
					<input type="text" id="txt1" size="10"><br><br>
					Saisir la traduction :
					<br>
					<br>
					<!-- <div id="div1"></div> -->
					<input type="text" id="txt2" size="10"><br>
					<br>
					<input type="button" class="btn btn-dark" id="btn1" value="Vérifier">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-dark" id="btn2" value="Suivant">
					<br>
					<br>
					<p id="txttaille"></p>
					<p id="txttips"></p>
					<p id="txtplace"></p>
				</div>
				<div class="col-12 col-md-4">
					Résultat :
					<p id="+"></p>
					<p id="-"></p>
				</div>
			</div>
		</div>
	</center>
	<script>
		let erreur = 0
		let resultatplus = 0;
		let resultatmoins = 0;
		let th = document.getElementById("listeThemes");
		let motFr = new Array();
		let motsAngl = new Array();
		let number = document.getElementById('number');
		let francais = document.getElementById('txt1');
		let chK = document.getElementById('oui');
		let anglais = document.getElementById('txt2');
		let btn1 = document.getElementById('btn1');
		let btn2 = document.getElementById('btn2');
		let moins = document.getElementById('-');
		let plus = document.getElementById('+');
		let valider = document.getElementById('btnValider');
		let div1 = document.getElementById('div1');
		let radiobox = document.createElement('input');
		let txttips = document.getElementById('txttips');
		let txttaille = document.getElementById('txttaille');
		let txtplace = document.getElementById('txtplace');
		let newNum1 = Math.floor(Math.random() * 4);
		btn1.addEventListener('click', verification);
		btn2.addEventListener('click', suivant);
		valider.addEventListener('click', validation);

		function recupMot() {
			motFr = new Array();
			motsAngl = new Array();
			fetch("getMots.php?th=" + th.value)
				.then(response => response.json())
				.then(data => {
					for (let i = 0; i < data.length; i++) {
						motFr.push(data[i]["MotFr"])
						motsAngl.push(data[i]["MotAngl"])
						francais.value = motFr[newNum1];
						motsAnglais = motsAngl[newNum1];
					}

				})
				.catch(function(error) {
					console.log('Request failed', error);
				});

		}


		function suivant() {
			let test = newNum1;
			while (newNum1 == test) {
				newNum1 = Math.floor(Math.random() * motFr.length);
				anglais.value = "";
			}
			validation();
		}

		// 	function btnradio(){
		// 		div1.replaceChildren();
		// 		txttaille.innerHTML="";
		// 		txttips.innerHTML="";
		// 		txtplace.innerHTML="";
		// 		for (let i=0 ; i<motsAngl.length ; i++){
		// 	    // création du radio
		// 	    var radiobox = document.createElement('input');
		// 	    radiobox.type = 'radio';
		// 	    radiobox.id = i;
		// 	    radiobox.value = motsAngl[i];
		// 	    radiobox.name='rdobox';
		// 	    // création du label
		// 	    let label = document.createElement('label');
		// 	    label.htmlFor = i; 
		// 	    let description = document.createTextNode(motsAngl[i]);
		// 	    label.appendChild(description);
		// 	    // ajout saut ligne
		// 	    let newline = document.createElement('br');
		// 	    // ajout des éléments à la suite du paragraphe
		// 	    let div1 = document.getElementById('div1');
		// 	    div1.appendChild(radiobox);
		// 	    div1.appendChild(label);
		// 	    div1.appendChild(newline);
		// 	}
		// }

		function validation() {
			anglais.value = ""
			recupMot()
			anglais.hidden = false;
			if (chK.checked == true) {
				btnradio();
				anglais.hidden = true;
				number.value = 1;
			}
		}

		function verification() {
			// if (chK.checked==false){
			if (anglais.value == motsAnglais) {
				txttaille.innerHTML = "Bravo !";
				resultatplus += 1;
				plus.innerHTML = "Bonne réponse : " + resultatplus;
				txttips.innerHTML = "";
				txtplace.innerHTML = "";
			} else {
				if (erreur == number.value) {
					txttaille.innerHTML = "Perdu !";
					resultatmoins += 1;
					moins.innerHTML = "Mauvaise réponse : " + resultatmoins
					txttips.innerHTML = "";
					txtplace.innerHTML = "";
				} else {
					let bon = 0;
					let mal = 0;
					let mot = new Array();
					for (let i = 0; i < motsAnglais.length; i++) {
						if (anglais.value.charAt(i) == motsAnglais.charAt(i)) {

							bon++;
							mot.push(i);
						} else {
							for (let j = 0; j < motsAnglais.length; j++) {
								if (anglais.value.charAt(i) == motsAnglais.charAt(j)) {
									mal += 1;
								}
							}
						}
					}
					if (anglais.value.length < motsAnglais.length) {
						let taille = motsAnglais.length - anglais.value.length;
						if (taille > 1) {
							txttaille.innerHTML = "Il manque " + taille + " lettres";
						} else {
							txttaille.innerHTML = "Il manque " + taille + " lettre";
						}
					}
					if (anglais.value.length > motsAnglais.length) {
						let taille = anglais.value.length - motsAnglais.length;
						if (taille > 1) {
							txttaille.innerHTML = "Il y a " + taille + " lettres en trop";
						} else {
							txttaille.innerHTML = "Il y a " + taille + " lettre en trop";
						}
					}
					if (anglais.value.length == motsAnglais.length) {
						txttaille.innerHTML = "";
					}
					if (bon > 1) {
						txttips.innerHTML = bon + " lettres biens placés";
						anglais.focus();
						erreur += 1;
					} else {
						txttips.innerHTML = bon + " lettre bien placé";
						anglais.focus();
						erreur += 1;
					}

					if (mal > 1) {
						txtplace.innerHTML = mal + " lettres mal placés";
						anglais.focus();
					} else {
						txtplace.innerHTML = mal + " lettre mal placé";
						anglais.focus();
					}
				}
			}
		}
		// else{
		// 	let rdobox = document.getElementsByName('rdobox');
		// 	for(let i = 0 ; i< rdobox.length ; i++) {
		//     	if (rdobox[i].checked==true) {
		// 			if(rdobox[i].value==motsAnglais){
		// 			txttaille.innerHTML="Bravo !";
		// 			resultatplus+=1;
		// 			plus.innerHTML="Bonne réponse : "+resultatplus;
		// 			}
		// 			else{
		// 			txttaille.innerHTML="Perdu !";
		// 			resultatmoins+=1;
		// 			moins.innerHTML="Mauvaise réponse : "+resultatmoins;
		// 			}
		// 		}
		// 	}
		// }
		//}	
	</script>
</body>

</html>