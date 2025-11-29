alert("Le fichier JS est bien chargé !");
/* =========================================
   PARTIE 1 : ADRESSE (Sécurisée)
   ========================================= */
const input = document.getElementById("adresse");
const suggestions = document.getElementById("suggestions");

// On vérifie si l'input existe AVANT d'essayer de l'utiliser
if (input && suggestions) {
    input.addEventListener("input", async () => {
        const query = input.value.trim();

        if (query.length < 3) {
            suggestions.style.display = "none";
            suggestions.innerHTML = "";
            return;
        }

        try {
            const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`);
            const data = await response.json();

            suggestions.innerHTML = "";
            suggestions.style.display = "block";

            data.features.forEach((feature) => {
                const li = document.createElement("li");
                li.textContent = feature.properties.label;
                li.style.padding = "10px";
                li.style.cursor = "pointer";
                li.style.borderBottom = "1px solid #eee";
                
                li.addEventListener("click", () => {
                    input.value = feature.properties.label;
                    suggestions.innerHTML = "";
                    suggestions.style.display = "none";
                });
                suggestions.appendChild(li);
            });
        } catch (error) {
            console.error("Erreur API:", error);
        }
    });
}

/* =========================================
   PARTIE 2 : MENU BURGER (Sécurisée)
   ========================================= */
var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

// On vérifie que le bouton ouvrir existe
if (openBtn) {
    openBtn.onclick = openNav;
}

// On vérifie que le bouton fermer existe
if (closeBtn) {
    closeBtn.onclick = closeNav;
}

function openNav(e) {
    // Si c'est un lien <a>, on empêche le site de remonter en haut
    if(e) e.preventDefault(); 
    if(sidenav) sidenav.classList.add("active");
}

function closeNav(e) {
    if(e) e.preventDefault();
    if(sidenav) sidenav.classList.remove("active");
}