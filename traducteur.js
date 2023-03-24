
	let erreur = 0 
	let Fruits = new Array("poire", "melon", "mangue", "raisin");
	let FruitsAnglais = new Array("pear", "melon", "mango","grape")
	let Sports = new Array("gymnastique", "golf", "football", "natation");
	let SportsAnglais = new Array("gymnastic", "golf", "soccer","swimming");
	let Maisons = new Array("salon", "toilette", "cave", "cuisine");
	let MaisonsAnglais = new Array("salon", "toilet", "cellar","kitchen");
	let Animaux = new Array("poisson", "chien", "chat", "souris");
	let AnimauxAnglais = new Array("fish", "dog", "cat","mouse");
	var tableau = ["un", "deux", "trois"];
tableau.splice(2, 1);
alert(tableau);
	let resultatplus=0;
	let resultatmoins=0;
	let motsAnglais = "";
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

	function suivant(){
		let test=newNum1;
		while(newNum1==test){
		newNum1 = Math.floor(Math.random() * 4);
		anglais.value="";
		}
		validation();
	}

	function btnradio(){
		div1.replaceChildren();
		txttaille.innerHTML="";
		txttips.innerHTML="";
		txtplace.innerHTML="";
		for (let i=0 ; i<motsAnglais.length ; i++){
	    // création du radio
	    var radiobox = document.createElement('input');
	    radiobox.type = 'radio';
	    radiobox.id = i;
	    radiobox.value = motsAnglais[i];
	    radiobox.name='rdobox';
	    // création du label
	    let label = document.createElement('label');
	    label.htmlFor = i; 
	    let description = document.createTextNode(motsAnglais[i]);
	    label.appendChild(description);
	    // ajout saut ligne
	    let newline = document.createElement('br');
	    // ajout des éléments à la suite du paragraphe
	    let div1 = document.getElementById('div1');
	    div1.appendChild(radiobox);
	    div1.appendChild(label);
	    div1.appendChild(newline);
	}
}

	function validation(){
		anglais.value=""
		let tabchoix = document.getElementsByName('choix');
		for(let i = 0 ; i< tabchoix.length ; i++) {
            if (tabchoix[i].checked==true) {
            	if(tabchoix[i].value=='Fruit'){
            		div1.replaceChildren();
            		anglais.hidden=false;
            		francais.value = Fruits[newNum1];
					motsAnglais = FruitsAnglais;
					if (chK.checked){
            			btnradio();
            			anglais.hidden=true;
            			number.value=1;
					}
            	}
            	if(tabchoix[i].value=='Sport'){
            		div1.replaceChildren();
            		anglais.hidden=false;
            		francais.value = Sports[newNum1];
					motsAnglais = SportsAnglais;
					if (chK.checked){
            			btnradio();
            			anglais.hidden=true;
            			number.value=1;
					}
            	}
            	if(tabchoix[i].value=='Maison'){
            		div1.replaceChildren();
            		anglais.hidden=false;
            		francais.value = Maisons[newNum1];
					motsAnglais = MaisonsAnglais;
					if (chK.checked){
            			btnradio();
            			anglais.hidden=true;
            			number.value=1;
					}
            	}
            	if(tabchoix[i].value=='Animaux'){
            		div1.replaceChildren();
            		anglais.hidden=false;
            		francais.value = Animaux[newNum1];
					motsAnglais = AnimauxAnglais;
					if (chK.checked){
            			btnradio();
            			anglais.hidden=true;
            			number.value=1;
					}
            	}
            }
		}
	}
	function verification(){
		if (chK.checked==false){
			if (anglais.value==motsAnglais[newNum1]){
				txttaille.innerHTML="Bravo !";
				resultatplus+=1;
				plus.innerHTML="Bonne réponse : "+resultatplus;
				txttips.innerHTML="";
				txtplace.innerHTML="";
			}
			else if (erreur==number.value){
				txttaille.innerHTML="Perdu !";
				resultatmoins+=1;
				moins.innerHTML="Mauvaise réponse : "+resultatmoins
				txttips.innerHTML="";
				txtplace.innerHTML="";
			}
			else{
				let bon = 0;
				let mal = 0;
				let mot = new Array();
				for(let i=0; i<motsAnglais[newNum1].length; i++){
					alert(motsAnglais[newNum1].charAt(i))
					if(anglais.value.charAt(i)==motsAnglais[newNum1].charAt(i)){

						bon++;
						mot.push(i);
					}
					else{
						for(let j=0; j<motsAnglais[newNum1].length; j++){
							if (anglais.value.charAt(i)==motsAnglais[newNum1].charAt(j)){
										mal+=1;
									}
								}
							}
						} 
				if(anglais.value.length<motsAnglais[newNum1].length){
					let taille = motsAnglais[newNum1].length-anglais.value.length;
					if(taille>1){
						txttaille.innerHTML="Il manque "+taille+" lettres";
					}
					else{
						txttaille.innerHTML="Il manque "+taille+" lettre";
					}
				}
				if(anglais.value.length>motsAnglais[newNum1].length){
					let taille = anglais.value.length-motsAnglais[newNum1].length;
					if(taille>1){
						txttaille.innerHTML="Il y a "+taille+" lettres en trop";
					}
					else{
						txttaille.innerHTML="Il y a "+taille+" lettre en trop";
					}
				}
				if(anglais.value.length==motsAnglais[newNum1].length){
					txttaille.innerHTML="";
				}
				if(bon>1){
					txttips.innerHTML=bon+" lettres biens placés";
					anglais.focus();
					erreur+=1;
				}
				else{
					txttips.innerHTML=bon+" lettre bien placé";
					anglais.focus();
					erreur+=1;
				}
				
				if(mal>1){
					txtplace.innerHTML=mal+" lettres mal placés";
					anglais.focus();
				}
				else{
					txtplace.innerHTML=mal+" lettre mal placé";
					anglais.focus();
				}
			}
		}
		else{
			let rdobox = document.getElementsByName('rdobox');
			for(let i = 0 ; i< rdobox.length ; i++) {
            	if (rdobox[i].checked==true) {
					if(rdobox[i].value==motsAnglais[newNum1]){
					txttaille.innerHTML="Bravo !";
					resultatplus+=1;
					plus.innerHTML="Bonne réponse : "+resultatplus;
					}
					else{
					txttaille.innerHTML="Perdu !";
					resultatmoins+=1;
					moins.innerHTML="Mauvaise réponse : "+resultatmoins;
					}
				}
			}
		}
	}	
