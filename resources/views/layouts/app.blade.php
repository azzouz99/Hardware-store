<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hardware Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- If using Laravel Breeze --}}
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- 🔼 Header --}}
    <header>
    <x-header />
    </header>

    {{-- 📦 Page Content --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    {{-- 🔽 Footer --}}
    <footer class="bg-white shadow p-4 mt-12">
    <x-footer />
    </footer>
<!-- jQuery -->


<!-- Bootstrap JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
function menuData() {
  return {
    categories: [
      {
        name: 'Robinetterie',
        icon: '/images/icons/shower.svg',
        open: false,
        subcategories: [
          { name: 'Robinet lavabo et vasque', open: false, subsubcategories: ['Robinet de lavabo', 'Mélangeur de lavabo', 'Mitigeur de lavabo','Mitigeur de vasque','Robinet temporise pour lavabo','Robinet électronique'] },
          { name: 'Robinet baignoire', open: false, subsubcategories: ['Mélangeur de baignoire', 'Mitigeur de baignoire'] },
          { name: 'Robinet bidet', open: false, subsubcategories: ['Mélangeur de bidet', 'Mitigeur de bidet'] },
          { name: 'Robinet douche', open: false, subsubcategories:  ['Mélangeur de douche', 'Mitigeur de douche'] },
          { name: 'Robinet évier', open: false, subsubcategories: ['Mélangeur d\'évier', 'Mitigeur d\'évier'] },
          { name: 'Robinet temporise', open: false, subsubcategories: ['Robinet temporise wc', 'Robinet temporise douche', 'Robinet temporise lavabo'] },
          { name: 'Robinet wc', open: false, subsubcategories: ['Mélangeur wc', 'Mitigeur wc', 'Robinet wc'] },
          { name: 'Robinet extérieur', open: false, subsubcategories: ['Robinet jardin'] },
          { name: 'Robinet machine à laver', open: false, subsubcategories: ['Robinet machine à laver'] },
          { name: 'Accesoires de robinet', open: false, subsubcategories: ['Accesoires et piéces de rechange'] },
        ]
      },
      {
        name: 'Plomberie et Chauffage',
        icon: '/images/icons/plumb.svg',
        open: false,
        subcategories: [
          { name: 'Tube et raccord', open: false, subsubcategories: ['Tube pvc evacuation','Accessoires tube pvc','Cuivre sanitaire et gaz','Accessoires tube cuivre',
            'Tube multicouche','Accessoires tube multicouche','Tube polyethylene','Accessoires tube polyethylene','Robinet d\'arret cuivre','Accessoires et divers',
            'Collecteur cuivre','Collecteur multicouche','Compteur d\'eau et accessoires','Raccordement gaz','Cuivre frigorifique','Tube pvc pression','Robinet d\'arret multicouche'
          ] },
          { name: 'Chaudière à gaz', open: false, subsubcategories: ['Chaudière mixte', 'Chaudière simple', 'Equipement de chauffage central'] },
          { name: 'Chauffe Bains', open: false, subsubcategories: ['Chauffe Bains à gaz','Chauffe Bains électrique','Accessoires pour chauffe bains'] },
          { name: 'Radiateur et séche-serviettes', open: false, subsubcategories: ['Élément de radiateur','Séche-Serviette','Accessoires pour chauffage'] },
          { name: 'Regard de caniveau et de siphon', open: false, subsubcategories: ['Regard et accessoires','Caniveau et siphon'] },
          { name: 'Traitement de l\'air', open: false, subsubcategories: ['Accessoires pour aspirateur et aérateur'] },
          { name: 'Traitement de l\'eau', open: false, subsubcategories: ['Filtre à eau et accessoires','Osmoseur à eau et accessoires'] },
          { name: 'Vidage', open: false, subsubcategories: ['Vidage et accessoires'] },
          { name: 'Divers plomberie chauffage', open: false, subsubcategories: ['Divers plomberie chauffage'] },
        ]
      },
      {
            name: 'Peinture Et Droguerie',
            icon: '/images/icons/paint.svg',
            open: false,
            subcategories: [
                {
                name: 'Peinture',
                open: false,
                subsubcategories: [
                    'Peinture à eau',
                    'Peinture laque',
                    'Peinture antirouille',
                    'Lazure et vernis',
                    'Peinture décorative',
                    'Divers peinture',
                    'Peinture spéciale'
                ]
                },
                {
                name: 'Outil De Peinture',
                open: false,
                subsubcategories: [
                    'Abrasif et papier verre',
                    'Pinceau peinture',
                    'Ruban de masquage',
                    'Couteau et taloche à enduit',
                    'Manchon pour rouleau',
                    'Autre outils de peinture',
                    'Rouleau peinture'
                ]
                },
                {
                name: 'Preparation Des Supports',
                open: false,
                subsubcategories: [
                    'Peinture primaire et impression',
                    'Enduit',
                    'Toile de verre et revetement mural'
                ]
                },
                {
                name: 'Entretien Et Restauration',
                open: false,
                subsubcategories: [
                    'Colle,mastic de fixation',
                    'Silicone',
                    'Produits d\'entretien d\'hygiene',
                    'Lubrifiant'
                ]
                },
                {
                name: 'Droguerie',
                open: false,
                subsubcategories: [
                    'Diluant et essence'
                ]
                }
            ]
        },
      {
            name: 'Outillage',
            icon: '/images/icons/tools.svg', // Update this path/icon if needed
            open: false,
            subcategories: [
                {
                name: 'Outil Electroportatif',
                open: false,
                subsubcategories: [
                    'Perceuse',
                    'Visseuse et clé à choc',
                    'Meuleuse et rainureuse',
                    'Perforateur',
                    'Scie circulaire',
                    'Scie électrique',
                    'Scie sauteuse',
                    'Ponceuse et polisseuse',
                    'Défonceuse et affleureuse',
                    'Rabot électrique',
                    'Malaxeur',
                    'Décapeur thermique',
                    'Pistolet à colle',
                    'Souffleur et aspirateur',
                    'Outils multifonction',
                    'Accessoires et consommables'
                ]
                },
                {
                name: 'Outil À Main',
                open: false,
                subsubcategories: [
                    'Agrafeuse et cloueuse',
                    'Pince et tenaille',
                    'Coupe bouton',
                    'Tournevis',
                    'Marteau et massette',
                    'Clé mixte',
                    'Clé à pipe',
                    'Clé à cliquet',
                    'Clé à molette',
                    'Clé à chaine',
                    'Clé torx et six pans',
                    'Clé à griffe',
                    'Pistolet à colle chaude',
                    'Pistolet Silicone',
                    'Outils de decoupe',
                    'Rangement d\'outils',
                    'Filetage et tarudage'
                ]
                },
                {
                name: 'Outil De Peinture',
                open: false,
                subsubcategories: [
                    'Rouleau de peinture',
                    'Pinceau peinture',
                    'Couteau et taloche à enduit',
                    'Manchon pour rouleau',
                    'Autre outils de peinture',
                ]
                },
                {
                name: 'Mesure Et Traçage',
                open: false,
                subsubcategories: [
                    'Mètre déroulant',
                    'Cordeau',
                    'Régle et reglet',
                    'Equerre et pied à coulisse',
                    'Niveaux laser et niveaux à bulle',
                    'Télémètre laser'
                ]
                },
                {
                name: 'Levage Et Travail En Hauteur',
                open: false,
                subsubcategories: [
                    'Treuil, cric, palan et accessoires',
                    'Échelle, escabeau et echaufaudage',
                ]
                },
                {
                name: 'Outil De Mesure Electronique',
                open: false,
                subsubcategories: [
                    'Testeur et détecteur de tension'
                ]
                },
                {
                name: 'Outil De Finition',
                open: false,
                subsubcategories: [
                    'Lime et brosse métallique'
                ]
                },
                {
                name: 'Scie À Main Et Lame De Scie',
                open: false,
                subsubcategories: [
                    'Scie à bois',
                    'Scie à métaux'
                ]
                },
                {
                name: 'Soudure Et Accessoire',
                open: false,
                subsubcategories: [
                    'Soudure à la flamme',
                    'Accessoires et consommables'
                ]
                },
                {
                name: 'Equipement',
                open: false,
                subsubcategories: [
                    'Equipement de protection'
                ]
                }
            ]
        },
      {
        name: 'Salle de bain',
        icon: '/images/icons/bath.svg', // Update this path if needed
        open: false,
        subcategories: [
            {
            name: 'Douche et Accessoires',
            open: false,
            subsubcategories: [
                'Receveur de douche',
                'Barre, pommeau et element de douche',
                'Colonne de douche',
                'Cabine et ensemble de douche',
                'Barre de maintien',
                'Accessoires de douche',
                'Mélangeur de douche',
                'Mitigeur de douche'
            ]
            },
            {
            name: 'WC et Accessoires',
            open: false,
            subsubcategories: [
                'Cuvette',
                'Chasse d\'eau wc',
                'Mécanisme de wc',
                'Abattant pour wc',
                'Melangeur wc',
                'Mitigeur wc',
                'Accessoires wc',
                'Robinet wc',
                'Urinoir',
                'Robinet temporise wc'
            ]
            },
            {
            name: 'Vasques et Accessoires',
            open: false,
            subsubcategories: [
                'Vasque a poser',
                'Vasque a encastrer',
                'Accessoires pour vasque',
                'Mitigeur de vasque'
            ]
            },
            {
            name: 'Baignoire et Accessoires',
            open: false,
            subsubcategories: [
                'Baignoire',
                'Melangeur de baignoire',
                'Accessoires de baignoire',
                'Mitigeur de baignoire'
            ]
            },
            {
            name: 'Lavabo et Accessoires',
            open: false,
            subsubcategories: [
                'Lavabo',
                'Robinet de lavabo',
                'Melangeur de lavabo',
                'Mitigeur de lavabo',
                'Accessoires de lavabo',
                'Robinet électronique',
                'Robinet temporise lavabo'
            ]
            },
            {
            name: 'Bidet et Accessoires',
            open: false,
            subsubcategories: [
                'Bidet',
                'Accessoires bidet',
                'Melangeur de bidet',
                'Mitigeur de bidet'
            ]
            },
            {
            name: 'Meuble Salle de Bain',
            open: false,
            subsubcategories: [
                'Meuble salle de bain'
            ]
            },
            {
            name: 'Accessoires Salle de Bain',
            open: false,
            subsubcategories: [
                'Accessoires salle de bain'
            ]
            }
        ]
      },
      {
            name: 'Jardin et piscine',
            icon: '/images/icons/garden.svg', // Adjust path/icon as needed
            open: false,
            subcategories: [
                {
                name: 'Outil De Jardinage Manuel',
                open: false,
                subsubcategories: [
                    'Fourche',
                    'Pelle',
                    'Houe',
                    'Balai',
                    'Sécateur',
                    'Coupe branche',
                    'Scie à couteau',
                    'Cisaille à haie',
                    'Binette'
                ]
                },
                {
                name: 'Outil De Jardin Motorisés',
                open: false,
                subsubcategories: [
                    'Tondeuse à gazon',
                    'Débroussailleuse',
                    'Taille-haies',
                    'Nettoyeur haute pression'
                ]
                },
                {
                name: 'Arrosage Et Récupération D\'eau',
                open: false,
                subsubcategories: [
                    'Pompe de surface',
                    'Pompe immergée',
                    'Enrouleur et tuyau d\'arrosage',
                    'Arroseur, pistolet et lance',
                    'Divers arrosage et récupération d\'eau'
                ]
                },
                {
                name: 'Accessoires De Piscine',
                open: false,
                subsubcategories: [
                    'Fontaine et cascade de piscine'
                ]
                },
                {
                name: 'Autre Outil Et Materiel De Jardin',
                open: false,
                subsubcategories: [
                    'Répulsif pour insectes et animaux'
                ]
                }
            ]
      },
      {
        name: 'Cuisine Et Dressing',
        icon: '/images/icons/kitchen.svg',
        open: false,
        subcategories: [
                {
                name: 'Electromenager',
                open: false,
                subsubcategories: [
                    'Four',
                    'Micro-ondes',
                    'Plaque de cuisson',
                    'Lave vaisselle',
                    'Hotte aspirante',
                    'Réfrigérateur',
                    'Accessoires et consommables'
                ]
                },
                {
                name: 'Evier Et Robinet',
                open: false,
                subsubcategories: [
                    'Evier',
                    'Accessoires pour evier',
                    'Melangeur d\'evier',
                    'Mitigeur d\'evier'
                ]
                },
                {
                name: 'Accessoires',
                open: false,
                subsubcategories: [
                    'Accessoires de cuisine',
                    'accessoires de dressing'
                ]
                },
                {
                name: 'Meuble',
                open: false,
                subsubcategories: [
                    'Meuble cuisine',
                    'Meuble dressing'
                ]
                }
            ]
      },
      {
        name: 'Electricite',
        icon: '/images/icons/elec.svg',
        open: false,
        subcategories: [
            {
            name: 'Gaines Et Cables Electriques',
            open: false,
            subsubcategories: [
                'Rallonge électrique et enrouleur',
                'Moulure, goulotte et tube',
                'Boite apparente',
                'Boite encastrement',
                'Accessoires',
                'Fils et cable'
            ]
            },
            {
            name: 'Tableau Electrique Et Equipement',
            open: false,
            subsubcategories: [
                'Tableau electrique',
                'Disjoncteur modulaire',
                'Disjoncteur differentiel',
                'Accessoires tableau électrique'
            ]
            },
            {
            name: 'Ampoule',
            open: false,
            subsubcategories: [
                'Ampoule led et economique',
                'Tube led, tube fluocomapcte',
                'Douille et accessoire pour ampoule'
            ]
            },
            {
            name: 'Interupteurs & Prises',
            open: false,
            subsubcategories: [
                'Interupteur',
                'Prise',
                'Fiche electrique',
                'Accessoires interupteur et prise'
            ]
            },
            {
            name: 'Luminaire D\'exterieur',
            open: false,
            subsubcategories: [
                'Projecteur',
                'Applique murale etanche'
            ]
            },
            {
            name: 'Luminaire D\'interieur',
            open: false,
            subsubcategories: [
                'Spot projecteur et accessoires',
                'Applique murale',
                'Reglette et plafonier'
            ]
            },
            {
            name: 'Lampe Portable',
            open: false,
            subsubcategories: [
                'Lampe torche',
                'Baladeuse',
            ]
            },
            {
            name: 'Domotique, Automatismes Et Securite',
            open: false,
            subsubcategories: [
                'Interphone et sonnette',
                'Detecteur de presence et alarme',
                'Audiovisuelle',
                'Eclairage de securite'
            ]
            },
            {
            name: 'Alimentation',
            open: false,
            subsubcategories: [
                'Pile et chargeur',
                'Alimentation et transformateur'
            ]
            }
        ]
      },
      {
        name: 'Etancheite Et Construction',
        icon: '/images/icons/construction.png',
        open: false,
        subcategories: [
          { 
            name: 'Etancheite', 
            open: false, 
            subsubcategories: ['Etancheite murs et sols'] },
          { 
            name: 'Isolation', 
            open: false, 
            subsubcategories: [
                'Joint et isolation'
            ]
         },
          { 
            name: 'Construction', 
            open: false, 
            subsubcategories: [
                'Mortier de pose et jointage',
                 'Adjuvant pour mortier',
                  'Accessoires de pose'
                ] 
            }
        ]
      },
      {
            name: 'Quincaillerie',
            icon: '/images/icons/quin.svg', // Update this path/icon if needed
            open: false,
            subcategories: [
                {
                name: 'Serrurerie Et Securite',
                open: false,
                subsubcategories: [
                    'Serrure à blocus',
                    'Serrure encastrée',
                    'Serrure électrique',
                    'Verroux',
                    'Cadenas à clé',
                    'Serrure anti-panique',
                    'Accessoire de verrou et serrure'
                ]
                },
                {
                name: 'Quincaillerie De Porte Et De Fenêtre',
                open: false,
                subsubcategories: [
                    'Poignée de porte et fenêtre',
                    'Joint et isolation de porte et fenêtre',
                    'Accessoire de porte et fenêtre',
                    'Ferme de porte'
                ]
                },
                {
                name: 'Quincaillerie De Meuble',
                open: false,
                subsubcategories: [
                    'Pied, roue et roulette de meuble',
                    'Charnière et paumelle pour meuble',
                    'Tiroirs et composants',
                    'Tringle et rideaux'
                ]
                },
                {
                name: 'Quincaillerie Exterieure',
                open: false,
                subsubcategories: [
                    'Boite aux lettres'
                ]
                },
                {
                name: 'Fixation Technique',
                open: false,
                subsubcategories: [
                    'Vis boulons douilles cheville'
                ]
                }
            ]
            }

      
    ]
  }
}
</script>


</script>
</body>
</html>
