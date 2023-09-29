

////////////////////////////////////////////
// On va chercher les différents éléments de notre page
const pages = document.querySelectorAll(".page")
const nbPages = pages.length // Nombre de pages du formulaire



// On attend le chargement de la page
window.onload = () => {
  // On affiche la 1ère page du formulaire
  document.querySelector(".page").style.display = "initial"


  // On gère les boutons "suivant"
  let boutons = document.querySelectorAll(".next")

  for(let bouton of boutons){
      bouton.addEventListener("click", pageSuivante)
  }

  // On gère les boutons "precedent"
  let boutons2 = document.querySelectorAll(".prev")

  for(let bouton of boutons2){
      bouton.addEventListener("click", pagePrecedente)
  }
}

/**
 * Cette fonction fait avancer le formulaire d'une page
 */
 function pageSuivante(){
  // On masque toutes les pages
  for(let page of pages){
      page.style.display = "none"
  }

  // On affiche la page suivante
  this.parentElement.nextElementSibling.style.display = "initial"
  window.scrollTo(0, 0)
}

/**
 * Cette fonction fait reculer le formulaire d'une page
 */
 function pagePrecedente(){
  // On masque toutes les pages
  for(let page of pages){
      page.style.display = "none"
  }

  // On affiche la page suivante
  this.parentElement.previousElementSibling.style.display = "initial"
  window.scrollTo(0, document.body.scrollHeight)
  
}
//////////////////////////////////////
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }
  }
}
/////////
 $('.autoplay').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      });
////////////////////////////////

function confirmDelete() {
  swal({
    title: "Êtes-vous sûr(e) ?",
    text: "Votre compte et son contenu seront supprimés!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      window.location.href = "delete_compte.php?id=<?=$id_annonceurs?>";
    }//  else {
    //   swal("Votre fichier imaginaire est en sécurité !");
    // }
  });

  return false; // Empêche le lien de se comporter normalement (d'ouvrir la page spécifiée dans le href)
}
///////////////////////////////
function confirmDelete2() {
  swal({
    title: "Êtes-vous sûr(e) ?",
    text: "votre annonce sera supprimée!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      window.location.href = "delete_annonce.php?id_annonces=<?= $res['id_annonces'] ?>";
    }//  else {
    //   swal("Votre fichier imaginaire est en sécurité !");
    // }
  });

  return false; // Empêche le lien de se comporter normalement (d'ouvrir la page spécifiée dans le href)
}