// Website by Tom Depussay 
// Version v1.0

let words = ['après', 'chambre', 'amour', 'enfant', 'monde', 'père', 'dont', 'femme', 'quelque', 'leur', 'nous', 'toujours', 'falloir', 'pendant', 'trop', 'premier', 'chaque', 'pour', 'fois', 'jamais', 'on', 'trouver', 'côté', 'voix', 'ton', 'moi', 'toi', 'savoir', 'coup', 'regard', 'que', 'soir', 'ici', 'tu', 'jusque', 'prendre', 'se', 'rue', 'comprendre', 'chercher', 'devenir', 'aimer', 'appeler', 'pied', 'quatre', 'demander', 'tête', 'aller', 'encore', 'depuis', 'ainsi', 'devant', 'ou', 'âme', 'mourir', 'seul', 'moins', 'mot', 'je', 'penser', 'puis', 'mon', 'dans', 'nuit', 'heure', 'main', 'par', 'moment', 'trois', 'mort', 'entre', 'grand', 'pouvoir', 'même', 'vouloir', 'comme', 'il', 'mille', 'y', 'coeur', 'te', 'sembler', 'eau', 'non', 'mer', 'chez', 'lequel', 'notre', 'vers', 'mettre', 'tant', 'devoir', 'beau', 'maintenant', 'ça', 'vie', 'mais', 'déjà', 'du', 'an', 'parler', 'car', 'venir', 'à', 'ami', 
'jeune', 'entendre', 'attendre', 'rendre', 'connaître', 'rien', 'air', 'homme', 'avant', 'son', 'tenir', 'lui', 'yeux', 'un', 'porte', 'regarder', 'pas', 'elle', 'ni', 'petit', 'maison', 'vous', 'dire', 'chose', 'quel', 'deux', 'sur', 'reprendre', 'gens', 'enfin', 'croire', 'sortir', 'rester', 'avec', 'oui', 'noir', 'voir', 'cent', 'sans', 'avoir', 'porter', 'ce', 'ville', 'vingt', 'faire', 'donc', 'alors', 'de', 'autre', 'qui', 'me', 'jour', 'en', 'votre', 'terre', 'dieu', 'revenir', 'ciel', 'pays', 'nom', 'entrer', 'passer', 'sentir', 'si', 'sous', 'aussi', 'mari', 'le', 'et', 'parce', 'vieux', 'monsieur', 'arriver', 'contre', 'ne', 'au', 'nouveau', 'peu', 'répondre', 'quand', 'tout', 'très', 'cela', 'où', 'être', 'plus', 'bon', 'celui', 'bien', 'donner', 'là', 'fille', 'temps', 'frère', 'vivre'];

// "hexakosioihexekontahexaphobie", "pseudopseudohypoparathyroïdie", "anticonstitutionnellement", "intergouvernementalisation", "hélicoptère"


let text = document.getElementById('text');
let input = document.getElementById('input-text');
let time = document.getElementById('time');
let score_input = document.getElementById('score_input');
let accuracy_input = document.getElementById('accuracy_input');

let list_wrong_char = [17,16,20,9,91,174,18,116];
let timer = 60;
let begin = false;
let word_current = 0;
let word_begin = 0;
let first_position = 0;
let good_char = 0;
let wrong_char = 0;
let char = "";

onload = function() {
    if (window.innerWidth < 600){
        document.getElementById("form").remove();
        let div = document.createElement("div");
        div.setAttribute("id", "error");
        div.innerHTML = "Votre écran est trop petit pour profiter pleinement de ce site. Veuillez changer de support. Merci";
        document.getElementById('container-game').appendChild(div);
    }
    else {
        input.focus();
        for (let i = 0; i < 300; i++) {
            let word = words[Math.floor(Math.random() * words.length)];
            text.innerHTML += "<span id='" + i + "'>" + word + "</span> ";
        }
        setHighlight("0");
        first_position = document.getElementById("0").getBoundingClientRect()["top"];
    }
}

document.addEventListener('keyup', function(event) {
    if(event.keyCode == 32) {
        good_char++;
        while (input.value.slice(-1) != " "){
            char = input.value.slice(-1) + char;
            input.value = input.value.slice(0,-1);
        }
        if (input.value.trim() == document.getElementById(word_current).innerHTML){
            setCorrect(word_current);
            word_current++;
            setHighlight(word_current);
            input.value = "";
            if (char != ""){
                input.value = char;
                char = "";
            }
        } else {
            setWrong(word_current);
            wrong_char++;
            word_current++;
            setHighlight(word_current);
            input.value = "";
            if (char != ""){
                input.value = char;
                char = "";
            }
        }
        if (document.getElementById(word_current).getBoundingClientRect()["top"] != first_position){
            for (let i = word_begin; i < word_current; i++) {
                document.getElementById(i).remove();
            }
            word_begin = word_current;
        }
    }

    if (!list_wrong_char.includes(event.keyCode) && event.keyCode != 32){
        let length_word = input.value.trim().length;
        if (input.value.trim() == document.getElementById(word_current).innerHTML.substring(0, length_word)){
            delHighlightWrong(word_current);
            setHighlight(word_current);
            if (event.keyCode != 8){
                good_char++;
            }
        } else {
            setHighlightWrong(word_current);
            wrong_char++;
        }
        if (!begin){
            begin = true;
            let interval = setInterval(function() {
                timer--;
                time.innerHTML = timer;
                if (timer == 0) {
                    clearInterval(interval);
                    end();
                }
            }, 1000);
        }
    }
});

function setHighlight(id) {
    let element = document.getElementById(id);
    element.className = "highlight";
}

function setHighlightWrong(id) {
    let element = document.getElementById(id);
    element.className = "highlight-wrong";
}

function delHighlightWrong(id) {
    let element = document.getElementById(id);
    element.className = "";
}

function setCorrect(id) {
    let element = document.getElementById(id);
    element.className = "correct";
}

function setWrong(id) {
    let element = document.getElementById(id);
    element.className = "wrong";
}

function end() {
    let score = Math.round((good_char-wrong_char)/60*10);
    let accuracy = Math.round(((good_char-wrong_char)/(good_char + wrong_char))*100);

    if (score < 0){
        score = 0;
    }
    if (accuracy < 0){
        accuracy = 0;
    }

    score_input.value = score;
    accuracy_input.value = accuracy;

    document.getElementById('form').submit();

    // document.location.href = "resultat.php?score=" + score + "&accuracy=" + accuracy;

    // document.getElementById('game').remove();
    // let container = document.createElement('div');
    // container.className = "container";
    // container.innerHTML = "<h1 class='title'>Résultat</h1><h2>Vous avez un score de <span class='correct'>" + Math.round(good_char/60*10) + "</span> caratère par minute<br>Vous avez une précision de " + Math.round(((good_char-wrong_char)/(good_char + wrong_char))*100) + "% (<span class='correct'>" + good_char + "</span>|<span class='wrong'>" + wrong_char + "</span>"+")</h2>";
    // container.innerHTML += "<button onclick='location.reload()'>Rejouer</button>";
    // document.body.appendChild(container);
}