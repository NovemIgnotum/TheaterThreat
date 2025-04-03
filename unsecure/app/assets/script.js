// Pour démontrer les vulnérabilités XSS
document.addEventListener("DOMContentLoaded", () => {
  console.log("Script chargé - TheaterThreat");

  // Démontre une vulnérabilité XSS stockée
  if (window.location.search.includes("xss=")) {
    alert("Mode XSS actif!");
  }
});
