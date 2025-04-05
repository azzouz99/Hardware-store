<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubsubCategory;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Robinetterie',
                'icon' => '/images/icons/shower.svg',
                'subcategories' => [
                    [
                        'name' => 'Robinet lavabo et vasque',
                        'subsubcategories' => [
                            'Robinet de lavabo',
                            'Mélangeur de lavabo',
                            'Mitigeur de lavabo',
                            'Mitigeur de vasque',
                            'Robinet temporise pour lavabo',
                            'Robinet électronique'
                        ],
                    ],
                    [
                        'name' => 'Robinet baignoire',
                        'subsubcategories' => [
                            'Mélangeur de baignoire',
                            'Mitigeur de baignoire'
                        ],
                    ],
                    [
                        'name' => 'Robinet bidet',
                        'subsubcategories' => [
                            'Mélangeur de bidet',
                            'Mitigeur de bidet'
                        ],
                    ],
                    [
                        'name' => 'Robinet douche',
                        'subsubcategories' => [
                            'Mélangeur de douche',
                            'Mitigeur de douche'
                        ],
                    ],
                    [
                        'name' => 'Robinet évier',
                        'subsubcategories' => [
                            'Mélangeur d\'évier',
                            'Mitigeur d\'évier'
                        ],
                    ],
                    [
                        'name' => 'Robinet temporise',
                        'subsubcategories' => [
                            'Robinet temporise wc',
                            'Robinet temporise douche',
                            'Robinet temporise lavabo'
                        ],
                    ],
                    [
                        'name' => 'Robinet wc',
                        'subsubcategories' => [
                            'Mélangeur wc',
                            'Mitigeur wc',
                            'Robinet wc'
                        ],
                    ],
                    [
                        'name' => 'Robinet extérieur',
                        'subsubcategories' => [
                            'Robinet jardin'
                        ],
                    ],
                    [
                        'name' => 'Robinet machine à laver',
                        'subsubcategories' => [
                            'Robinet machine à laver'
                        ],
                    ],
                    [
                        'name' => 'Accesoires de robinet',
                        'subsubcategories' => [
                            'Accesoires et piéces de rechange'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Plomberie et Chauffage',
                'icon' => '/images/icons/plumb.svg',
                'subcategories' => [
                    [
                        'name' => 'Tube et raccord',
                        'subsubcategories' => [
                            'Tube pvc evacuation',
                            'Accessoires tube pvc',
                            'Cuivre sanitaire et gaz',
                            'Accessoires tube cuivre',
                            'Tube multicouche',
                            'Accessoires tube multicouche',
                            'Tube polyethylene',
                            'Accessoires tube polyethylene',
                            'Robinet d\'arret cuivre',
                            'Accessoires et divers',
                            'Collecteur cuivre',
                            'Collecteur multicouche',
                            'Compteur d\'eau et accessoires',
                            'Raccordement gaz',
                            'Cuivre frigorifique',
                            'Tube pvc pression',
                            'Robinet d\'arret multicouche'
                        ],
                    ],
                    [
                        'name' => 'Chaudière à gaz',
                        'subsubcategories' => [
                            'Chaudière mixte',
                            'Chaudière simple',
                            'Equipement de chauffage central'
                        ],
                    ],
                    [
                        'name' => 'Chauffe Bains',
                        'subsubcategories' => [
                            'Chauffe Bains à gaz',
                            'Chauffe Bains électrique',
                            'Accessoires pour chauffe bains'
                        ],
                    ],
                    [
                        'name' => 'Radiateur et séche-serviettes',
                        'subsubcategories' => [
                            'Élément de radiateur',
                            'Séche-Serviette',
                            'Accessoires pour chauffage'
                        ],
                    ],
                    [
                        'name' => 'Regard de caniveau et de siphon',
                        'subsubcategories' => [
                            'Regard et accessoires',
                            'Caniveau et siphon'
                        ],
                    ],
                    [
                        'name' => 'Traitement de l\'air',
                        'subsubcategories' => [
                            'Accessoires pour aspirateur et aérateur'
                        ],
                    ],
                    [
                        'name' => 'Traitement de l\'eau',
                        'subsubcategories' => [
                            'Filtre à eau et accessoires',
                            'Osmoseur à eau et accessoires'
                        ],
                    ],
                    [
                        'name' => 'Vidage',
                        'subsubcategories' => [
                            'Vidage et accessoires'
                        ],
                    ],
                    [
                        'name' => 'Divers plomberie chauffage',
                        'subsubcategories' => [
                            'Divers plomberie chauffage'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Peinture Et Droguerie',
                'icon' => '/images/icons/paint.svg',
                'subcategories' => [
                    [
                        'name' => 'Peinture',
                        'subsubcategories' => [
                            'Peinture à eau',
                            'Peinture laque',
                            'Peinture antirouille',
                            'Lazure et vernis',
                            'Peinture décorative',
                            'Divers peinture',
                            'Peinture spéciale'
                        ],
                    ],
                    [
                        'name' => 'Outil De Peinture',
                        'subsubcategories' => [
                            'Abrasif et papier verre',
                            'Pinceau peinture',
                            'Ruban de masquage',
                            'Couteau et taloche à enduit',
                            'Manchon pour rouleau',
                            'Autre outils de peinture',
                            'Rouleau peinture'
                        ],
                    ],
                    [
                        'name' => 'Preparation Des Supports',
                        'subsubcategories' => [
                            'Peinture primaire et impression',
                            'Enduit',
                            'Toile de verre et revetement mural'
                        ],
                    ],
                    [
                        'name' => 'Entretien Et Restauration',
                        'subsubcategories' => [
                            'Colle,mastic de fixation',
                            'Silicone',
                            'Produits d\'entretien d\'hygiene',
                            'Lubrifiant'
                        ],
                    ],
                    [
                        'name' => 'Droguerie',
                        'subsubcategories' => [
                            'Diluant et essence'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Outillage',
                'icon' => '/images/icons/tools.svg',
                'subcategories' => [
                    [
                        'name' => 'Outil Electroportatif',
                        'subsubcategories' => [
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
                        ],
                    ],
                    [
                        'name' => 'Outil À Main',
                        'subsubcategories' => [
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
                        ],
                    ],
                    [
                        'name' => 'Outil De Peinture',
                        'subsubcategories' => [
                            'Rouleau de peinture',
                            'Pinceau peinture',
                            'Couteau et taloche à enduit',
                            'Manchon pour rouleau',
                            'Autre outils de peinture'
                        ],
                    ],
                    [
                        'name' => 'Mesure Et Traçage',
                        'subsubcategories' => [
                            'Mètre déroulant',
                            'Cordeau',
                            'Régle et reglet',
                            'Equerre et pied à coulisse',
                            'Niveaux laser et niveaux à bulle',
                            'Télémètre laser'
                        ],
                    ],
                    [
                        'name' => 'Levage Et Travail En Hauteur',
                        'subsubcategories' => [
                            'Treuil, cric, palan et accessoires',
                            'Échelle, escabeau et echaufaudage'
                        ],
                    ],
                    [
                        'name' => 'Outil De Mesure Electronique',
                        'subsubcategories' => [
                            'Testeur et détecteur de tension'
                        ],
                    ],
                    [
                        'name' => 'Outil De Finition',
                        'subsubcategories' => [
                            'Lime et brosse métallique'
                        ],
                    ],
                    [
                        'name' => 'Scie À Main Et Lame De Scie',
                        'subsubcategories' => [
                            'Scie à bois',
                            'Scie à métaux'
                        ],
                    ],
                    [
                        'name' => 'Soudure Et Accessoire',
                        'subsubcategories' => [
                            'Soudure à la flamme',
                            'Accessoires et consommables'
                        ],
                    ],
                    [
                        'name' => 'Equipement',
                        'subsubcategories' => [
                            'Equipement de protection'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Salle de bain',
                'icon' => '/images/icons/bath.svg',
                'subcategories' => [
                    [
                        'name' => 'Douche et Accessoires',
                        'subsubcategories' => [
                            'Receveur de douche',
                            'Barre, pommeau et element de douche',
                            'Colonne de douche',
                            'Cabine et ensemble de douche',
                            'Barre de maintien',
                            'Accessoires de douche',
                            'Mélangeur de douche',
                            'Mitigeur de douche'
                        ],
                    ],
                    [
                        'name' => 'WC et Accessoires',
                        'subsubcategories' => [
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
                        ],
                    ],
                    [
                        'name' => 'Vasques et Accessoires',
                        'subsubcategories' => [
                            'Vasque a poser',
                            'Vasque a encastrer',
                            'Accessoires pour vasque',
                            'Mitigeur de vasque'
                        ],
                    ],
                    [
                        'name' => 'Baignoire et Accessoires',
                        'subsubcategories' => [
                            'Baignoire',
                            'Melangeur de baignoire',
                            'Accessoires de baignoire',
                            'Mitigeur de baignoire'
                        ],
                    ],
                    [
                        'name' => 'Lavabo et Accessoires',
                        'subsubcategories' => [
                            'Lavabo',
                            'Robinet de lavabo',
                            'Melangeur de lavabo',
                            'Mitigeur de lavabo',
                            'Accessoires de lavabo',
                            'Robinet électronique',
                            'Robinet temporise lavabo'
                        ],
                    ],
                    [
                        'name' => 'Bidet et Accessoires',
                        'subsubcategories' => [
                            'Bidet',
                            'Accessoires bidet',
                            'Melangeur de bidet',
                            'Mitigeur de bidet'
                        ],
                    ],
                    [
                        'name' => 'Meuble Salle de Bain',
                        'subsubcategories' => [
                            'Meuble salle de bain'
                        ],
                    ],
                    [
                        'name' => 'Accessoires Salle de Bain',
                        'subsubcategories' => [
                            'Accessoires salle de bain'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Jardin et piscine',
                'icon' => '/images/icons/garden.svg',
                'subcategories' => [
                    [
                        'name' => 'Outil De Jardinage Manuel',
                        'subsubcategories' => [
                            'Fourche',
                            'Pelle',
                            'Houe',
                            'Balai',
                            'Sécateur',
                            'Coupe branche',
                            'Scie à couteau',
                            'Cisaille à haie',
                            'Binette'
                        ],
                    ],
                    [
                        'name' => 'Outil De Jardin Motorisés',
                        'subsubcategories' => [
                            'Tondeuse à gazon',
                            'Débroussailleuse',
                            'Taille-haies',
                            'Nettoyeur haute pression'
                        ],
                    ],
                    [
                        'name' => 'Arrosage Et Récupération D\'eau',
                        'subsubcategories' => [
                            'Pompe de surface',
                            'Pompe immergée',
                            'Enrouleur et tuyau d\'arrosage',
                            'Arroseur, pistolet et lance',
                            'Divers arrosage et récupération d\'eau'
                        ],
                    ],
                    [
                        'name' => 'Accessoires De Piscine',
                        'subsubcategories' => [
                            'Fontaine et cascade de piscine'
                        ],
                    ],
                    [
                        'name' => 'Autre Outil Et Materiel De Jardin',
                        'subsubcategories' => [
                            'Répulsif pour insectes et animaux'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Cuisine Et Dressing',
                'icon' => '/images/icons/kitchen.svg',
                'subcategories' => [
                    [
                        'name' => 'Electromenager',
                        'subsubcategories' => [
                            'Four',
                            'Micro-ondes',
                            'Plaque de cuisson',
                            'Lave vaisselle',
                            'Hotte aspirante',
                            'Réfrigérateur',
                            'Accessoires et consommables'
                        ],
                    ],
                    [
                        'name' => 'Evier Et Robinet',
                        'subsubcategories' => [
                            'Evier',
                            'Accessoires pour evier',
                            'Melangeur d\'evier',
                            'Mitigeur d\'evier'
                        ],
                    ],
                    [
                        'name' => 'Accessoires',
                        'subsubcategories' => [
                            'Accessoires de cuisine',
                            'accessoires de dressing'
                        ],
                    ],
                    [
                        'name' => 'Meuble',
                        'subsubcategories' => [
                            'Meuble cuisine',
                            'Meuble dressing'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Electricite',
                'icon' => '/images/icons/elec.svg',
                'subcategories' => [
                    [
                        'name' => 'Gaines Et Cables Electriques',
                        'subsubcategories' => [
                            'Rallonge électrique et enrouleur',
                            'Moulure, goulotte et tube',
                            'Boite apparente',
                            'Boite encastrement',
                            'Accessoires',
                            'Fils et cable'
                        ],
                    ],
                    [
                        'name' => 'Tableau Electrique Et Equipement',
                        'subsubcategories' => [
                            'Tableau electrique',
                            'Disjoncteur modulaire',
                            'Disjoncteur differentiel',
                            'Accessoires tableau électrique'
                        ],
                    ],
                    [
                        'name' => 'Ampoule',
                        'subsubcategories' => [
                            'Ampoule led et economique',
                            'Tube led, tube fluocomapcte',
                            'Douille et accessoire pour ampoule'
                        ],
                    ],
                    [
                        'name' => 'Interupteurs & Prises',
                        'subsubcategories' => [
                            'Interupteur',
                            'Prise',
                            'Fiche electrique',
                            'Accessoires interupteur et prise'
                        ],
                    ],
                    [
                        'name' => 'Luminaire D\'exterieur',
                        'subsubcategories' => [
                            'Projecteur',
                            'Applique murale etanche'
                        ],
                    ],
                    [
                        'name' => 'Luminaire D\'interieur',
                        'subsubcategories' => [
                            'Spot projecteur et accessoires',
                            'Applique murale',
                            'Reglette et plafonier'
                        ],
                    ],
                    [
                        'name' => 'Lampe Portable',
                        'subsubcategories' => [
                            'Lampe torche',
                            'Baladeuse'
                        ],
                    ],
                    [
                        'name' => 'Domotique, Automatismes Et Securite',
                        'subsubcategories' => [
                            'Interphone et sonnette',
                            'Detecteur de presence et alarme',
                            'Audiovisel',
                            'Eclairage de securite'
                        ],
                    ],
                    [
                        'name' => 'Alimentation',
                        'subsubcategories' => [
                            'Pile et chargeur',
                            'Alimentation et transformateur'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Etancheite Et Construction',
                'icon' => '/images/icons/construction.png',
                'subcategories' => [
                    [
                        'name' => 'Etancheite',
                        'subsubcategories' => [
                            'Etancheite murs et sols'
                        ],
                    ],
                    [
                        'name' => 'Isolation',
                        'subsubcategories' => [
                            'Joint et isolation'
                        ],
                    ],
                    [
                        'name' => 'Construction',
                        'subsubcategories' => [
                            'Mortier de pose et jointage',
                            'Adjuvant pour mortier',
                            'Accessoires de pose'
                        ],
                    ]
                ],
            ],
            [
                'name' => 'Quincaillerie',
                'icon' => '/images/icons/quin.svg',
                'subcategories' => [
                    [
                        'name' => 'Serrurerie Et Securite',
                        'subsubcategories' => [
                            'Serrure à blocus',
                            'Serrure encastrée',
                            'Serrure électrique',
                            'Verroux',
                            'Cadenas à clé',
                            'Serrure anti-panique',
                            'Accessoire de verrou et serrure'
                        ],
                    ],
                    [
                        'name' => 'Quincaillerie De Porte Et De Fenêtre',
                        'subsubcategories' => [
                            'Poignée de porte et fenêtre',
                            'Joint et isolation de porte et fenêtre',
                            'Accessoire de porte et fenêtre',
                            'Ferme de porte'
                        ],
                    ],
                    [
                        'name' => 'Quincaillerie De Meuble',
                        'subsubcategories' => [
                            'Pied, roue et roulette de meuble',
                            'Charnière et paumelle pour meuble',
                            'Tiroirs et composants',
                            'Tringle et rideaux'
                        ],
                    ],
                    [
                        'name' => 'Quincaillerie Exterieure',
                        'subsubcategories' => [
                            'Boite aux lettres'
                        ],
                    ],
                    [
                        'name' => 'Fixation Technique',
                        'subsubcategories' => [
                            'Vis boulons douilles cheville'
                        ],
                    ]
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'icon' => $catData['icon'],
            ]);

            foreach ($catData['subcategories'] as $subData) {
                $subcategory = Subcategory::create([
                    'name' => $subData['name'],
                    'category_id' => $category->id,
                ]);

                foreach ($subData['subsubcategories'] as $subsubName) {
                    SubsubCategory::create([
                        'name' => $subsubName,
                        'subcategory_id' => $subcategory->id,
                    ]);
                }
            }
        }
    }
}
