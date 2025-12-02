# 🛡️ Portfolio - Nohan BROCHARD (SISR & Pentest)

![Status](https://img.shields.io/badge/Status-Online-success?style=for-the-badge)
![Tech](https://img.shields.io/badge/Stack-HTML%20%7C%20Tailwind%20%7C%20JS%20%7C%20PHP-blue?style=for-the-badge)
![Focus](https://img.shields.io/badge/Focus-Cybersecurity%20%26%20Network-red?style=for-the-badge)

> **"Sécuriser l'Infrastructure, le Réseau, la Data, le Périmètre."**

Bienvenue sur le dépôt source de mon portfolio professionnel. Ce projet n'est pas seulement une vitrine de mon CV, mais une démonstration technique de mes compétences en développement web, en scripting et en sensibilisation à la cybersécurité.

🔗 **Voir le site en live :** [https://nbrd.fr](https://nbrd.fr)

---

## ⚡ Fonctionnalités Clés

Ce portfolio a été conçu comme une "War Room" interactive. Voici les modules techniques intégrés :

### 🎨 Frontend & UI (Glassmorphism)
* **Design Moderne :** Utilisation de **Tailwind CSS** pour un design "Glassmorphism" sombre et épuré.
* **Linux Boot Sequence :** Simulation d'un démarrage de kernel Linux au premier chargement (avec gestion de `sessionStorage`).
* **Responsive :** Interface adaptative (Mobile/Desktop) avec menu burger animé.

### 💻 Interactivité & Scripting
* **Terminal JS Interactif :** Un shell simulé codé en JavaScript pur.
    * Commandes supportées : `help`, `whoami`, `skills`, `impec`, `clear`, etc.
    * Sanitization des entrées (protection XSS DOM-based).
* **Veille Automatisée :** Agrégateur de flux RSS en temps réel via l'API `rss2json`.
    * Sources : ANSSI (CERT-FR), IT-Connect, The Hacker News.
    * Système d'onglets dynamiques.
* **Badges Dynamiques :** Intégration via API des stats **TryHackMe** en temps réel.

### 🛡️ Sécurité & Backend (Le côté SISR)
* **Honeypot (Pot de Miel) :**
    * Lien "Admin" caché dans le footer (pixel invisible).
    * Détection des clics suspects.
    * **Proxy PHP Sécurisé (`webhook.php`) :** Envoi d'alertes vers Discord sans exposer le Webhook côté client.
    * **Détection d'IP :** Algorithme robuste pour récupérer l'IPv4 réelle (contournement des proxies/load balancers OVH).
* **Sécurité HTTP :**
    * Protection contre le Directory Listing (`Options -Indexes`).
    * Gestion des erreurs 403/404 personnalisées.
    * Fichier `security.txt` conforme à la RFC 9116.
* **Protection basique :** Scripts anti-clic droit et désactivation des raccourcis d'inspection (Niveau 1).

### 🐇 Easter Eggs
* **Konami Code :** Faites `↑ ↑ ↓ ↓ ← → ← → B A` pour activer le mode Matrix "IMPEC".
* **Self-Destruct :** Un bouton rouge dans le footer avec animation de crash système.
* **Console Logs :** Message caché pour les développeurs ouvrant F12.

---

## 🛠️ Installation & Déploiement

Ce projet est conçu pour être hébergé sur un serveur web standard (Apache/Nginx) avec support PHP (pour le Honeypot).

### 1. Cloner le dépôt
```bash
git clone [https://github.com/ton-pseudo/portfolio-sisr.git](https://github.com/ton-pseudo/portfolio-sisr.git)
cd portfolio-sisr
