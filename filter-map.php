<div class="row">
    <div class="filtre map " id="filtre map">
        <div class="row justify-content-center justify-content-md-around justify-content-lg-center">
            <div class="filtre-form col-10 my-2  col-sm-6 col-md-5 col-lg-3 " style="z-index: 1;">
                <!-- comptage du nombre d'annonce -->
                <?php
                $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = 'oui' AND statuts = 'en cours'");
                $req->execute();
                $count_annonce = $req->rowCount();
                ?>
                <h6 class="pb-2">
                    <?php if (
                        $count_annonce > 1
                    ) : ?>
                        Sélectionnez la meilleure offre parmi les <br> <span> (<?= $count_annonce; ?>) </span> annonces disponibles sur SEEK.
                          
                    <?php elseif (
                        $count_annonce === 0
                    ) : ?>
                        Aucune annonce <span>(<?= $count_annonce; ?>)</span> disponible pour votre recherche.
                    <?php elseif (
                        $count_annonce === 1
                    ) : ?>
                        Profitez de l'unique offre <span>(<?= $count_annonce; ?>)
                        </span> disponible maintenant.
                    <?php endif; ?>
                </h6>
                <!-- fin comptage du nombre d'annonce -->

                <form method="POST" action="" class="row g-3">
                    <!-- type -->
                    <div class="col-12">
                        <select id="inputState" class="form-select" name="type" value="<?php echo isset($_POST['type']) ? htmlspecialchars($_POST['type']) : ''; ?>">
                            <option selected disabled>Types</option>
                            <option value="Appartement">Appartement</option>
                            <!-- <option value="Airbnb">Airbnb</option> -->
                            <option value="Bureau">Bureau</option>
                            <!-- <option value="Chalet">Chalet</option> -->
                            <option value="Chambre">Chambre</option>
                            <option value="Duplex">Duplex</option>
                            <option value="Entrepôt">Entrepôt</option>
                            <option value="Ferme">Ferme</option>
                            <!-- <option value="Hôtel">Hôtel</option> -->
                            <option value="Immeuble">Immeuble</option>
                            <option value="Local">Local</option>
                            <option value="Maison">Maison</option>
                            <!-- <option value="Loft">Loft</option> -->
                            <option value="Studio">Studio</option>
                            <!-- <option value="Résidence">Résidence</option> -->
                            <option value="Terrain">Terrain</option>
                            <!-- <option value="Triplex">Triplex</option> -->
                            <option value="Villa">Villa</option>
                        </select>
                    </div>
                    <!-- ville -->
                    <div class="col-12">
                        <select id="inputState" name="ville" class="form-select" value="<?php echo isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : ''; ?>">
                            <option selected disabled>Villes</option>
                            <option value="Dakar">Dakar</option>
                            <option value="Diourbel">Diourbel</option>
                            <option value="Fatick">Fatick</option>
                            <option value="Kaffrine">Kaffrine</option>
                            <option value="Kaolack">Kaolack</option>
                            <option value="Kédougou">Kédougou</option>
                            <option value="Kolda">Kolda</option>
                            <option value="Louga">Louga</option>
                            <option value="Matam">Matam</option>
                            <option value="Saint-Louis">Saint-Louis</option>
                            <option value="Sédhiou">Sédhiou</option>
                            <option value="Tambacounda">Tambacounda</option>
                            <option value="Thiès">Thiès</option>
                            <option value="Ziguinchor">Ziguinchor</option>
                        </select>
                    </div>
                    <!-- quartier -->
                    <div class="col-12">
                        <select id="inputState" name="quartier" class="form-select" value="<?php echo isset($_POST['quartier']) ? htmlspecialchars($_POST['quartier']) : ''; ?>">
                            <option selected disabled>Quartier</option>
                            <optgroup label="Dakar">
                                <option value="Amitié">Amitié</option>
                                <option value="Almadies">Almadies</option>
                                <option value="Almadies 2">Almadies 2</option>
                                <option value="Bambilor">Bamilor</option>
                                <option value="Bargny">Bargny</option>
                                <option value="Bel air">Bel air</option>
                                <option value="Biscuiterie">Biscuiterie</option>
                                <option value="Bobab">Baobab</option>
                                <option value="Cambérène">Cambérène</option>
                                <option value="Castors">Castors</option>
                                <option value="Cité asecna">Cité asecna</option>
                                <option value="Cité assemblée">Cité assemblée</option>
                                <option value="Cité avion">Cité avion</option>
                                <option value="Cité batrain">Cité Batrain</option>
                                <option value="Cité biagui">Cité Biagui</option>
                                <option value="Cité damel">Cité Damel</option>
                                <option value="Cité djily mbaye">Cité Djily Mbaye</option>
                                <option value="Cité keur gorgui">Cité Keur Gorgui</option>
                                <option value="Cité mixta">Cité mixta</option>
                                <option value="Colobane">Colobane</option>
                                <option value="Comico">comico</option>
                                <option value="Dalifort">Dalifort</option>
                                <option value="Derkle">Derkle</option>
                                <option value="Diamaguene">Diamaguene</option>
                                <option value="Diamniadio">Diamniadio</option>
                                <option value="Dieuppeul">Dieuppeul</option>
                                <option value="Djidah thiaroye kaw">Djidah thiaroye kaw</option>
                                <option value="Djily mbaye">Djily mbaye</option>
                                <option value="Fann">Fann</option>
                                <option value="Fann hock">Fann Hock</option>
                                <option value="Fann résidence">Fann Résidence</option>
                                <option value="Fass">Fass</option>
                                <option value="Fenêtre mermoz">Fenêtre mermoz</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Golf">Golf</option>
                                <option value="Gorom">Gorom</option>
                                <option value="Gorée">Gorée</option>
                                <option value="Grand dakar">Grand Dakar</option>
                                <option value="Grand yoff">Grand yoff</option>
                                <option value="Guediawaye">Guediawaye</option>
                                <option value="Gueule-tapée">Gueule-tapée</option>
                                <option value="Guinaw rail">Guinaw rail</option>
                                <option value="Hann bel-air">Hann Bel-Air</option>
                                <option value="Hann marinas">Hann marinas</option>
                                <option value="Hann maristes">Hann Maristes</option>
                                <option value="Hlm">Hlm</option>
                                <option value="Hlm grand-yoff">Hlm grand-yoff</option>
                                <option value="Karack">Karack</option>
                                <option value="Keur massar">Keur Massar</option>
                                <option value="Keur ndiaye lô">Keur ndiaye lô</option>
                                <option value="Kounoune">Kounoune</option>
                                <option value="Lac rose">Lac rose</option>
                                <option value="Liberté 1">Liberté 1</option>
                                <option value="Liberté 2">Liberté 2</option>
                                <option value="Liberté 3">Liberté 3</option>
                                <option value="Liberté 4">Liberté 4</option>
                                <option value="Liberté 5">Liberté 5</option>
                                <option value="Liberté 6">Liberté 6</option>
                                <option value="Liberté 6 extension">Liberté 6 extension</option>
                                <option value="Malika">Malika</option>
                                <option value="Mamelles">Mamelles</option>
                                <option value="Mbao">Mbao</option>
                                <option value="Mermoz">Mermoz</option>
                                <option value="Médina">Médina</option>
                                <option value="Ndiakhirate">Ndiakhirate</option>
                                <option value="Ngor">Ngor</option>
                                <option value="Niague">Niague</option>
                                <option value="Niakoul rap">Niakoul rap</option>
                                <option value="Niarry tally">Niarry Tally</option>
                                <option value="Nord foire">Nord Foire</option>
                                <option value="Ouakam">Ouakam</option>
                                <option value="Ouest foire">Ouest Foire</option>
                                <option value="Parcelles assainies">Parcelles Assainies</option>
                                <option value="Patte d'oie">Patte d'oie</option>
                                <option value="Pikine">Pikine</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Point E">Point E</option>
                                <option value="Rufisque">Rufisque</option>
                                <option value="Sacré coeur">Sacré Coeur</option>
                                <option value="Sangalkam">Sangalkam</option>
                                <option value="Sebikotane">Sebikotane</option>
                                <option value="Sendou">Sendou</option>
                                <option value="Scat urban">Scat urban</option>
                                <option value="Sicap liberté">Sicap Liberté</option>
                                <option value="Sicap sacré coeur">Sicap sacré coeur</option>
                                <option value="Sicap baobab">Sicap baobab</option>
                                <option value="Sicap foire">Sicap foire</option>
                                <option value="Sicap mbao">Sicap mbao</option>
                                <option value="Siprés">Siprés</option>
                                <option value="Sud foire">Sud foire</option>
                                <option value="Thiaroye">Thiaroye</option>
                                <option value="Thongor">Thongor</option>
                                <option value="Tivaounane peulh">Tivaounane peulh</option>
                                <option value="Toubab dialao">Toubab Dialao</option>
                                <option value="Vdn">VDN</option>
                                <option value="Virage">Virage</option>
                                <option value="Yene">Yene</option>
                                <option value="Yeumbeul">Yeumbeul</option>
                                <option value="Yoff">Yoff</option>
                                <option value="Zac mbao">Zac mbao</option>
                                <option value="Zone de captage">Zone de Captage</option>
                                <option value="Zone industrielle">Zone industrielle</option>
                            </optgroup>
                            <optgroup label="Diourbel">
                                <option value="Bambey">Bambey</option>
                                <option value="Diourbel">Diourbel</option>
                                <option value="Mbacke">Mbacke</option>
                            </optgroup>
                            <optgroup label="Fatick">
                                <option value="Diofior">Diofior</option>
                                <option value="Fatick">Fatick</option>
                                <option value="Foundiougne">Foundiougne</option>
                                <option value="Gossas">Gossas</option>
                                <option value="Karang poste">Karang poste</option>
                                <option value="Passi">Passi</option>
                                <option value="Sokone">Sokone</option>
                                <option value="Soum">Soum</option>
                            </optgroup>
                            <optgroup label="Kaffrine">
                                <option value="Birkilane">Birkilane</option>
                                <option value="Kaffrine">Kaffrine</option>
                                <option value="Koungheul">Koungheul</option>
                                <option value="Mabo">Mabo</option>
                                <option value="Malem hodar">Malem hodar</option>
                                <option value="Nganda">Nganda</option>
                            </optgroup>
                            <optgroup label="Kaolack">
                                <option value="Fass">Fass</option>
                                <option value="Gandiaye">Gandiaye</option>
                                <option value="Guinguineo">Guinguineo</option>
                                <option value="Kahone">Kahone</option>
                                <option value="Kaolack">Kaolack</option>
                                <option value="Keur madiabel">Keur madiabel</option>
                                <option value="Mboss">Mboss</option>
                                <option value="Ndoffane">Ndoffane</option>
                                <option value="Nioro du rip">Nioro du rip</option>
                                <option value="Sibassor">Sibassor</option>
                            </optgroup>
                            <optgroup label="Kédougou">
                                <option value="Kedougou">Kedougou</option>
                                <option value="Salemata">Salemata</option>
                                <option value="Saraya">Saraya</option>
                            </optgroup>
                            <optgroup label="Kolda">
                                <option value="Dabo">Dabo</option>
                                <option value="Diaobe kabendou">Diaobe kabendou</option>
                                <option value="Kolda">Kolda</option>
                                <option value="Kounkane">Kounkane</option>
                                <option value="Medina yoro foulah">Medina yoro foulah</option>
                                <option value="Pata">Pata</option>
                                <option value="Salikegne">Salikegne</option>
                                <option value="Sare yoba diega">Sare yoba diega</option>
                                <option value="Velingara">Velingara</option>
                            </optgroup>
                            <optgroup label="Louga">
                                <option value="Dahra">Dahra</option>
                                <option value="Gueoul">Gueoul</option>
                                <option value="Kebemer">Kebemer</option>
                                <option value="Leona">Leona</option>
                                <option value="Linguere">Linguere</option>
                                <option value="Louga">Louga</option>
                                <option value="Mbeuleukhe">Mbeuleukhe</option>
                                <option value="Nguene sarr">Nguene sarr</option>
                                <option value="Sakal">Sakal</option>
                                <option value="Thiep">Thiep</option>
                            </optgroup>
                            <optgroup label="Matam">
                                <option value="Dembancane">Dembacane</option>
                                <option value="Hamadi hounare">Hamadi hounare</option>
                                <option value="Kanel">Kanel</option>
                                <option value="Matam">Matam</option>
                                <option value="Nguidjilone">Nguidjilone</option>
                                <option value="Odobere">Odobere</option>
                                <option value="Ouaounde">Ouaounde</option>
                                <option value="Ourossogui">Ourossogui</option>
                                <option value="Ranerou">Ranerou</option>
                                <option value="Semme">Semme</option>
                                <option value="Sinthiou bamambe banadji">Sinthiou bamambe banadji</option>
                                <option value="Thilogne">Thilogne</option>
                            </optgroup>
                            <optgroup label="Saint-Louis">
                                <option value="Aere Lao">Aere Lao</option>
                                <option value="Bode lao">Bode lao</option>
                                <option value="Dagana">Dagana</option>
                                <option value="Demette">Demette</option>
                                <option value="Gae">Gae</option>
                                <option value="Galoya toucouleur">Galoya toucouleur</option>
                                <option value="Gnith">Gnith</option>
                                <option value="Gollere">Gollere</option>
                                <option value="Guede chantier">Guede chantier</option>
                                <option value="Mboumba">Mboumba</option>
                                <option value="Mpal">Mpal</option>
                                <option value="Ndioum">Ndioum</option>
                                <option value="Ndombo sandjiry">Ndombo sandjiry</option>
                                <option value="Niandane">Niandane</option>
                                <option value="Pete">Pete</option>
                                <option value="Podor">Podor</option>
                                <option value="Richard toll">Richard toll</option>
                                <option value="Ross bethio">Ross bethio</option>
                                <option value="Roso Senegal">Roso Senegal</option>
                                <option value="Saint-Louis">Saint-Louis</option>
                                <option value="Walalde">Walalde</option>
                            </optgroup>
                            <optgroup label="Sédhiou">
                                <option value="Bounkiling">Bounkiling</option>
                                <option value="Dianah malary">Dianah malary</option>
                                <option value="Diattacounda">Diattacounda</option>
                                <option value="Dioudoubou">Dioudoubou</option>
                                <option value="Djinany">Djinany</option>
                                <option value="Goudomp">Goudomp</option>
                                <option value="Kaour">Kaour</option>
                                <option value="Madina wandifa">Madina wandifa</option>
                                <option value="Marssassoum">Marssassoum</option>
                                <option value="Ndiamalathiel">Ndiamalathiel</option>
                                <option value="Samine">Samine</option>
                                <option value="Simbandi brassou">Simbandi brassou</option>
                                <option value="Sédhiou">Sédhiou</option>
                                <option value="Tanaff">Tanaff</option>
                            </optgroup>
                            <optgroup label="Tambacounda">
                                <option value="Bakel">Bakel</option>
                                <option value="Diawara">Diawara</option>
                                <option value="Goudiry">Goudiry</option>
                                <option value="Kidira">Kidira</option>
                                <option value="Kothiary">Kothiary</option>
                                <option value="Koumpentoum">Koumpentoum</option>
                                <option value="Maleme niani">Maleme niani</option>
                                <option value="Mereto">Mereto</option>
                                <option value="Tambacounda">Tambacounda</option>
                            </optgroup>
                            <optgroup label="Thiès">
                                <option value="Diass">Diass</option>
                                <option value="Diender">Diender</option>
                                <option value="Fandene">Fandene</option>
                                <option value="Fissel">Fissel</option>
                                <option value="Guereo">Guereo</option>
                                <option value="Joal fadiouth">Joal fadiouth</option>
                                <option value="Kayar">Kayar</option>
                                <option value="Keur moussa">Keur moussa</option>
                                <option value="Khombole">Khombole</option>
                                <option value="Malicounda">Malicounda</option>
                                <option value="Mbodiene">Mbodiene</option>
                                <option value="Mboro">Mboro</option>
                                <option value="Mbour">Mbour</option>
                                <option value="Meckhe">Meckhe</option>
                                <option value="Ndiaganiao">Ndiaganiao</option>
                                <option value="Ngaparou">Ngaparou</option>
                                <option value="Ngoundiane">Ngoundiane</option>
                                <option value="Nguekhokh">Nguekhokh</option>
                                <option value="Ngueniene">Ngueniene</option>
                                <option value="Nguering">Nguering</option>
                                <option value="Nianing">Nianing</option>
                                <option value="Notto">Notto</option>
                                <option value="Pambal">Pambal</option>
                                <option value="Pointe sarene">Pointe sarene</option>
                                <option value="Popenguine">Popenguine</option>
                                <option value="Pout">Pout</option>
                                <option value="Saly">Saly</option>
                                <option value="Saly portudal">Saly portudal</option>
                                <option value="Sandiara">Sandiara</option>
                                <option value="Sessene">Sessene</option>
                                <option value="Sindia">Sindia</option>
                                <option value="Somone">Somone</option>
                                <option value="Tassette">Tassette</option>
                                <option value="Thiadiaye">Thiadiaye</option>
                                <option value="Thienaba">Thienaba</option>
                                <option value="Thiès">Thiès</option>
                                <option value="Tivaouane">Tivaouane</option>
                                <option value="Touba toul">Touba toul</option>
                                <option value="Touba dialaw">Touba dialaw</option>
                                <option value="Warang">Warang</option>
                            </optgroup>
                            <optgroup label="Ziguinchor">
                                <option value="Bignona">Bignona</option>
                                <option value="Cap skirring">Cap skirring</option>
                                <option value="Diouloulou">Diouloulou</option>
                                <option value="Oussouye">Oussouye</option>
                                <option value="Thionck essyl">Thionck essyl</option>
                                <option value="Ziguinchor">Ziguinchor</option>
                            </optgroup>


                        </select>
                    </div>
                    <!-- prix -->
                    <div class="col-md-6">
                        <input type="number" name="min" class="form-control" placeholder="Minimum" min="0" value="<?php echo isset($_POST['min']) ? htmlspecialchars($_POST['min']) : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="max" class="form-control" placeholder="Maximum" min="0" value="<?php echo isset($_POST['max']) ? htmlspecialchars($_POST['max']) : ''; ?>">
                    </div>

                    <?php if (!empty($error_prix)) : ?>
                        <span class=" text-warning  text-center m-0 p-0" style="font-weight: 500; font-size:0.9rem;">
                            <?= $error_prix ?>
                        </span>
                    <?php endif; ?>
                    <!-- fin prix -->
                    <?php if (!empty($errors_critere)) : ?> <p class=" text-warning  text-center mt-1 p-0" style="font-weight: 500; font-size:0.9rem;">
                            <?= $errors_critere ?>
                        </p>
                    <?php endif; ?>
                    <!-- buton -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary" name="rechercher">Rechercher</button>
                    </div>
                </form>
            </div>
            <!-- map -->
            <div class="filtre-carte map__image  d-none d-md-flex my-2 col-5 align-items-center justify-content-lg-center  col-lg-5 mx-2" id="filtre-carte">
                <svg baseprofile="tiny" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" version="1.2" viewbox="0 0 1000 737" width="1000" xmlns="http://www.w3.org/2000/svg">
                    <?php
                    $sedhiou = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Sédhiou' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $sedhiou->execute();
                    $sedhiou_count = $sedhiou->rowCount();

                    ?>
                    <a xlink:title="Sédhiou : <?= $sedhiou_count ?> annonce(s)" xlink:href="annonce_ville.php?ville=Sédhiou">
                        <path id="region-sédhiou" d="M356.5 560.2l-0.4 7.3-1.5 6.3-1.9 6.4 1 5.8 5.7 4 7.6 1.4 2.4 3.9 3.3 8.8 0.5 5.4 0.5 3.9 5.2 3.4 5.7 3.9-0.5 4.4 0.5 5.9 3.3 3.9 2.9 4.9 0 13.7-2.4 5.3-1.4 4.9 1.3 10.2-7.9 0-4.7 0.7-4.2 1.9-9.4 6.8-9.9 4.6-9 6.7-40.9 19.2-5.6 1.2-28-1.7-0.7-1-5-7.4-1.6-3.6-3-4.3-2.3-4.9-0.4-4.4 0.1-1 2.6 2.1 1.3 1.5 1.9 0.4 10.4 0.1 1 0.8 2.1 2.2 0.8 0.4 1.4-0.2 4.1-1 1.9-1.2 1.8-2.2 2.3-1.3 3.4 1.5 0.9-0.8 1-0.5 1 0 2.3 1.6 1.7-0.5 0.9 0.2 1.3 1.5 1.1 2.8 0.9 1.3 1 0.9 1.2 0.7 1.4 0.5 2 0 1.8-0.4 7.4-3 3-3.1 5-6.5 1.8-1.3 1.7-0.9 1.2-1.2 0.4-2.2-0.9-1.1-1.8-0.7-1-0.9 1.4-1.4-1.6-3.7-1.5-5.1-0.5-5.2 1.4-4.1 1.9-1.2 2.3-0.1 2.4 0.3 2.2-0.3 2.3-1 1.5-1.2 1.1-1.5 0.7-2 3.3 3.3 3.1 0.9 2-1.8 0.4-4.6-2.5 2.6-2.4-0.1-2.4-1-2.6-0.4-2.5 1.1-4 3-2.9 0.6-1.6 0-2.5 0.3-2.2 1.2-0.9 2.4 0 9.7 1.8 6.2 0.3 1.7 0.1 2.7-0.1 1.4-0.5 1.1-3.9 3.4-1.3 1.6-8.1 7.5-2.2 1.3-1.9 0.1-1.7-0.7-1.4-1.2 0.9-5-4.9-2.3-11.5-1.8-7.8 5-2.9 0.7-1.3-1.7-1.1-1.2-2-0.6-1.9 0.4-2.8 1.6-1.9 0.3-1.9-0.5-2.5-1.3-4-2.7-0.2-0.8 0.3-2.3-0.6-0.4-2.2-0.3-1.8-0.8-1-1.3-2.2-4.4-2-1.5-0.6-3.5-0.9-1.9-0.2-1.5 0.3-2.3 0.7-1.5 1.4-10.3 0.3-1 0.9-1.1 1.7-1.6 0.7-2 0.3-3.5 0.5-1.7-0.8-2.8-0.2-1.8 0.2-1.9 7.3-11.7 6.5-13.6 0-1.2-0.9-1.2-2.3-0.9-1.1-0.6-0.2-1.4 0.8-2 2.8-3.1 1.5-2.6 10.4 0 1.1-0.8 0.3-11.8 0.4-14.4 0.6-2.4 1.9-1 11.3-1.1 7.3-2.4 2 0 10.9 1.1 2.7-0.3 4.9-1.7 3.7-2 3.8-1.4 5 0.2 17.7 3.8 6 0z" name="Sédhiou">
                        </path>
                    </a>
                    <?php
                    $kedougou = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Kédougou' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $kedougou->execute();
                    $kedougou_count = $kedougou->rowCount();

                    ?>
                    <a xlink:href="annonce_ville.php?ville=Kédougou" xlink:title="Kédougou : <?= $kedougou_count ?> annonce(s)">
                        <path id="region-kédougou" d="M914.4 556.9l0.4 1.8 1.4 0.4 4.3 2.1 1.2 1 0.6 1.2 1.1 3.2 0.7 1.2 1.9 1.6 0.9 0.1 0.9-1 6.8-5.1 0.4-3.3 1-3.4 1.6-2.7 2.5-1.4 2.3 0.4 1.2 1.3 0.9 1.6 1.6 1.3 1.6 0.2 3.1-0.7 4.1-0.1 0.8 0.7-0.3 2.4 0.5 1.6 1.8 0.2 2-0.5 1.2-0.5 0 3.6 1.1 3.2 4 5.6 3.7 3.3 0.7 1.6-0.3 1.8-2 3-0.6 1.8 0.5 3 1.5 2 1.9 1.8 1.5 2.2 0.1 5.8 0.8 2.7 2.9 0.7 2.2 1.4 2 1.4 2 1.3 2.6 0.7 1.8 0.7-0.2 1.1-0.9 1.3-0.4 1 2.3 3.2 0.9 2 0.6 1.1 0.7 0.5 1.4 0.7-0.3 0.7-1.4 1.4 0 1.4-0.4 3.2-0.5 1.7 2.6 0.5 1.8-0.8 1.2-1.9 0.4-2.9 1.4 1.5 0.7 1.7 0.4 1.9 0.3 4.3-0.5 1-1.1 0.6-1.4 1.2-0.7 0-2.2-1-1 0.6-0.1 1 1.7 1.8 0.3 0.9-0.6 1.7-0.9 1.7-0.6 1.7 0.5 2.7-1.2 2.3 0.1 1.1 2 0.7 1.3 2 0.5 1.4 0.4 1.7 0.1 2-0.3 1.8-1.2 1.2 0 0.7 1.7 3.1 0.3 1.6-1.3 2.1-2.2 0.4-2.2 0.7-1.7 4.4-1.2 0.9-1 1.2 0.1 2.5 1.9 0.9 1.2 0.9 0.8 1.7 0.1 1.7-0.9 5.2 0.2 1.8 0.5 2.4-0.4 1.9-3.3 1.5-1.2 1.1 1.8 0.6 1.2 0.8 1.9 3.3 1.3 1.1-0.1-1.2 0.9-1.8 1.2-0.5 1 2.7 0.4 1.4 1 2.7 0.3 1.5 1.3-2 0.3-1 2.1 2.9-0.3 3.9-1.1 4.4-0.3 4.4-4.5-0.2-10.6-3.9-5.5-0.5-14 1-6.7 1.3-12.5 4.7-6.1 1-13.2-0.6-3.4-0.7-9.8-4.1-0.5-0.5-1.1 0-0.7 0.3-1.8 1.3-6.2 3.3-2.1 0.5-3.5-0.4-9.8-3.2-4 0.1-2.9 1.4-5.4 5-6 3.3-27.3 7.2-2.7-1.3-4.6-7.1-2.9-2.1-7-2.6-3.4-0.8-2.8-0.2-2.7 0.6-3.2 1.2-4.7 2.7-1.4 0.4-2.3-0.1-0.6-0.6-0.2-1.2-0.8-1.6-4.6-5.1-2.7-2.2-3.1-1.3-3.3-0.4-10.5 0.6-3.4-0.4-0.9-1.4-0.7-1.6-2.6-1.2-4.8-0.4-1.5-0.6-1.7-1.6-0.4-1.4 0.3-1.8-4-3.5-6.3-3.3-5.9 0-2.7 6.7-0.6 3.2-1.8 1.6-2.7 0.2-2.9-1.1-3.1 0.3-2.8-0.3-2.4-1.3-1.9-2.7-0.7-3.2 0.6-2.7 2.4-5.7 0.6-2.8 0.2-3.4-0.7-3.1-2.1-2.3-2.5-0.4-2.8 0.5-2.9 0.1-2.9-1.5-1.6 1.8-1.3-0.8-1-0.1-2.6 0.1-2.7 0.7-0.8-0.3-1.5-1.7-0.9-0.4-1.2 0-2.8 0.8-1.4 0.2-1.4-0.2-2-1.3-1.3-0.4-1.5 0.1-4.8 1.1-0.8 0.2-0.8 0.9-1 0.1-0.8-0.3-1.3-1-1.3-0.5 0.5-2.6-1.3-3.2-2.1-1-1 0.2-2 0.9-1.8 0.3-3.7 0-2.1-0.3-1.7-0.7-2.1-1-1.2-1-1.1-1.4-0.3-1 0.2-0.9 0.8-1.4 0.2-0.9 0.4-6.1-0.2-1-0.9-2.5-1.1-1.2-0.5-2.2 0.6-1.6 1.4-2.2 0-0.9-1.2-1.3 0.4-0.7 1.8 0.1 0.7-0.4 0.2-1.1-0.6-1.2-0.7-3.9-0.7-0.7-2.2-1.5-1.5-1.7-0.5-1.4-0.6-2.6-0.8-1.1-0.3-1 1.1-2.3-0.7-5.1-1-1-2.1-0.7-0.3-0.7 0.6-1.4 0.3-1-0.4-0.7-1.1-1.1-1.2-1.6-1.8-1.9-2.5-1.6-0.4-0.8 0.1-3.1-2.4-1.8-2.1-2.5-1.2-2.4-0.2-1.6-0.2-2.7-0.7-1.3-0.1-1 0.4-2-0.1-2.6 0.2-1.2-0.2-3.6-0.4-1.1-0.5-0.8-0.7-0.4-0.1-1.5 3.8-1.8 0.1-8.9 2.7-2-0.5 2.8 1 1.2 1.9 0.6 1.6-0.3 0.9-2 0.8-1 2.4-1.2 3.2-0.9 2.1 0.7-1.1 3.6 2.1-0.9 1.4-3.9 1.5-0.9 6.6 0 6.2 1.2 2-0.9 1.7-1 1.5 0.3 1.5 2.6-1.6 2.7-1.3 1.5-0.7 1.4 0.1 2.5 1.1 2.6 0.1 1.4 0.6 0.6 2.2-0.1 0.9 1.6 2.2 1.3 0.8 0.6 0.1 0.8-0.6 1.5 1 1.7 0.6 2.2-0.7 2.3-0.3 2.2 2.1 1.8-6.6 2.4 0 1 3.3 1.5 0.6 4.1-0.3 5 0.8 4.3 3.1 3.6 3.2 0.9 7.1-2.1 4.6-1.8 2.4 0 4.7 0.5 4.3 1.5 2.9 2.4 2.8 0 1.4-2.4 1.5-1.5 3.3 0 6.7-3.4 9 0 3.3 1.4 2.9 3 2.4 0 3.8 3.9 4.2 2.9 3.4 1 1.4-2.5 0-1.9 1.4-1.5 2.9 0 2.4-1 0.4-2.9 1.5-1.5 3.3 0.5 2.4 1 2.3-0.5 0-2.9 1.5-2.9 3.8-2.5 2.4-2.9-1-3.9 0-3.9 2.4-2 3.3-0.5 3.3 0 2.9-1.4 1.9-1.5 4.7 2.9 3.9 0.5 5.2-1.5 2.8-1.9 1.9-3.4 0.5-3.5 1.9-2.4 3.3-0.5 1-2.4 2.4-2 4.3-1 3.8 1 2.3 2.9 1.9 1.5 1.9-0.5 1-2.9 1.4-2 1-3.9 1.9-1 5.2 1 4.3 0 2.4-2.9-1-3.9-4.7-5.9-1-2.9 2.4-2.5 0-3.9 3.8-1.5 4.8 3 4.2 3.4 4.8 2.4 4.7 3 5.8 1.4 4.2 1.5 1 3.4 0.9 3.9 3.4 0 4.2-2.9 4.3-4.9 5.7-1.5 9.5-1.7z" name="Kédougou">
                        </path>
                    </a>
                    <?php
                    $kaffrine = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Kaffrine' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $kaffrine->execute();
                    $kaffrine_count = $kaffrine->rowCount();

                    ?>
                    <a xlink:href="annonce_ville.php?ville=Kaffrine" xlink:title="Kaffrine : <?= $kaffrine_count ?> annonce(s)">
                        <path id="region-kaffrine" d="M434.2 347l3 2.6 4.4 2.1 26.3 7.8 2.6 1.1 1.1 1.1 0.2 2.1 0 1.9-0.3 2.5-0.2 31.6 3.7 10.9 2.1 3 0.8 3 0.8 12.7 1.4 7.4 0.4 3.3 0 2.8-1.5 6.9-1.3 2.2-3 1.3-0.9 0.7-0.6 2.9 0.1 3-0.7 3.2-0.4 0.8-9.6 9.2-3.8 3.1-0.7 0.4-7.5 1.9-1.6 0.7-3 0.3-2 0.3-1.6 0.7-2.3 2.4-1.9 2.7-2.9 5.1-0.7 2.2-3-2.5-6-2-16.3-0.7-9.7-3.7-3.4-0.2-11.9 4.4-12.2 7.9-3.4 0.8-1.4-1.1-3.1-4.2-1.6-1.4-7-1.1-7.5 2.8-8.2-3.8-4.7 0-6.5-0.7-11.2-4.8-3.5 5.5-2.9 4.8-3 1.2-4.1-1.8-4.7-4.9-2.3-4.8 0-4.2 1.7-4.3-0.6-4.2-7-4.3-5.9-6-1.8-3.7-0.5-4.2-2.4-3.1-7.1-1.2 0-19.4 1.8-6.1 4.1-9.1 3-7.3 0.2-16.1 4.3-3.4 3.7-4.7 6.4-7.3 4.2-0.4 3.7-2 7.6-6.2 3.4-2.7 3.7-0.8 7.9-1.2 8.7-1.5 6-1.6 4.9-5.4 3.5-15.4 12.9 7.9 8.2 3.1 24.7 5 5.5 0.5 3.8-0.9 3.1-1.2 14.4-8.9 2.7-1.3 2.7-0.6 2 1.6 3.7 5z" name="Kaffrine">
                        </path>
                    </a>
                    <?php
                    $saint_Louis = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Saint-Louis' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $saint_Louis->execute();
                    $saint_Louis_count = $saint_Louis->rowCount();

                    ?>
                    <a xlink:href="annonce_ville.php?ville=Saint-Louis" xlink:title="saint-Louis : <?= $saint_Louis_count ?> annonce(s)">
                        <path id="region-saint-Louis" d="M619.5 95l-6.8 14.2-16.4 6.7-2.4 6.1-18.2 16.6-25.9 21.4-24.1 18.9-6.5-4.9-12.3-6.1-13.5-7.3-7.1-9.8-8.2-12.2-18.3-12.9-8.5 0.6-13-7-2.7-1-92.8-0.2-1.1 11.3-25.5 1.8-1.8-1.2-33.3-38.4-3.4-3.1-2-1.3-1.6 1.8-2.7 2-3.1 1.6-1.2 1.1-0.7 1.7-1.7 2.9-1.1 1.4-1 0.7-30.6 17.4-0.9 0.5-5.6 4.7-1.1 1.3-0.8 1.4-0.5 1.8-0.4 0.8-0.9 0.7-6.9 3.6-1.7 1.4-1 2-2.1 5.6-0.7 1.2-1.2 1.3-2.3 0.4-2.5 0.1-2.8 0.4-2.2 0.9-3.5 2.6-3.1 1-3.1 0.6-26.4 0.6-0.3-0.6 3.7-6.3 1.6-9.3 0.4-18.4 0.9-1.9 2.3-7.5 2.8-6.8 0.7-11.4 1.2-3.4 2.3-2.1 6-1.4 2.6-1.7 1-1.7 0.7-2 6.6-28.6 0.8-6.7 1.3-3.2 2.2-3.2 3-2.9 3.5-2.1 3.6-0.8 5.4 1.1 1.8 0.1 1.9-0.3 1.6-0.8 4.8-3.4 1.8-0.9 2-0.4 2 0.4 1.5 1 1.2 1.2 2 2.9 2.7 3 3.3 1.6 3.7 0.4 3.8-0.6 2.3-1.4 1.3-0.2 1.3 0.3 2.1 0.9 1 0.1 1.2-0.3 6.4-2.9 2.3-0.2 5.7 1.4 1.4 0 4-0.8 2.5 0.2 7.4 2.4 5.2 0.3 1.4 0.4 3.8 1.8 2.6 0.7 2.5-0.2 2.3-0.8 2.3-1.4 3.6-3.3 1.9-1.2 2.5-0.4 6.9 1.4 2.4-0.2 1.9-1 1.6-1.4 3.9-5.7 2-1.8 2.4-1.1 2.4 0.2 1.6 1.3 0.9 1.7 1.1 1.6 2 0.9 2.4-0.1 2.3-0.6 6.8-2.8 2.5-0.6 5.2-0.2 7.7 1.3 2.6-0.1 17.4-2.8 3.4-1.3 1.1-0.7 0.7-1 0-1.2-0.5-1.1-2.6-2.6-1-2.2 0.3-2.2 1.5-1.7 2.3-0.6 2.3 0.7 1.5 1.6 1.2 2 1.7 1.6 1.2 0.4 1.2-0.1 1.1-0.5 1.1-0.8 0.7-1 0.4-1.1 0.5-2.4 1.1-1.6 1.6-1.1 3.7-1.5 1.8 0.9 2.1 2.3 1.4 2.8 1.7 2.1 3 0.5 4.9-1.2 27.7 2 1.9-0.2 5.4-1.5 1.6 0 1.5 0.4 4.5 2.2 1.8 0.3 1.8-0.1 6.8-1.9 1.7 0 6.6 1.3 1.7 0.1 1.8-0.2 1.7-0.5 1.6-0.7 4.2-2.6 1.6-0.6 3.1-0.2 10.3 4.1 1.3 0.8 0.6 1.3 0 1.8-0.9 3.3 0.3 1.3 1.5 0.7 6.2-0.6 1.6 0.7 0.5 1.4 0.3 3 0.8 1.3 1.7 0.8 3.9 0.3 1.8 0.3 1.3 0.8 2.8 3.6 1.1 1.1 3.9 2.7 5.5 6.5 9.6 8.8 5.4 3.1 1.1 1.1 2.8 3.4 1.5 0.9 3.1 1.3 1.5 0.8 1 1.1 0.1 1.2-1 2.6-0.3 1.5 0.3 1.1 1.6 2.1 0.7 1.5 0.1 1.4-0.8 3 0.6 2.7 2.7 1.5 6.4 1.9 1.3 0.8 2.6 2 1 1.1 0.8 1.4 1.4 4.5 0.8 1.7 1 1.4 1.3 1.3 1.5 0.9 1.3 0.4 1.3-0.2 1.3-0.4 2.7-1.6 2.6-2 1.1-1.2 2.9-4.2 1.2-1.2 1.4-0.8 1.4-0.4 1.5-0.1 1.5 0.2-0.3 2.1-1.6 5.1 0.5 1.8z" name="Saint-Louis">
                        </path>
                    </a>
                    <?php
                    $dakar = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Dakar' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $dakar->execute();
                    $dakar_count = $dakar->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Dakar" xlink:title="Dakar : <?= $dakar_count ?> annonce(s)">
                        <path id="region-dakar" d="M63.8 351.1l-4.8-6.7-4.7-4.3-2.7-1.9-3.2-1.5-3.5-0.6-2.7-0.8-6.8-3.6-1.1-1.2-5.4 0-4.6-0.6-4.1 0.3-3.6 2.6 1.4 1.7 1.9 0.5-1.2 2.5-2.1 1 2.1 2.3-1 2.4-0.6 0.1-0.5 1-2.1-1.4-10.9-13.6-2.6-2.4 26.8-7.2 7.9-6.5 22.7-9.7 0.2 0.2 3.3 7.6 1 3 0.1 0.9 0.1 4 0.5 1.5 2.6 4.3 0.5 1.5 0.2 1.6-3.1 23z" name="Dakar">
                        </path>
                    </a>
                    <?php
                    $diourbel = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Diourbel' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $diourbel->execute();
                    $diourbel_count = $diourbel->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Diourbel" xlink:title="Diourbel : <?= $diourbel_count ?> annonce(s)">
                        <path id="region-diourbel" d="M228.5 291.4l5.2-4.6 3.7-0.9 39.8-0.3 2.4 0.5 0 1.5 0.1 2.2 0.5 1.9 1.1 1.2 1.8 0.8 1.1 1 0.9 2.6 1.1 1.2 0.7 0.5 4 1.8 2.8 1.9 0.9 1.4 0.2 0.9 0.1 2.2 0.8 2.2 2.9 2.3 4.1-1.3 8.6-0.3 4.5 0.4 3.6 2.3 2.4 0.9 1.5 0.2 10.7-1 2.1 0.2 1.4 0.3 1.1 1.5 0.8 10.1 1 3.6 4.2 4.7 5.9 3.5-3.5 15.4-4.9 5.4-2.3-5.8-3.7-3.1-21.5-8.6-5.2-2.3-3.8-3.9-3-0.4-4.5 1.5-3.4 0.4-8.1-5.9-0.6 0.5-2.1 1.1-1.4 1.2-0.7 1.7-0.8 14.2-0.4 2-0.8 1.5-8.8 8.8-0.7 0.4-4 1.9-5.5 1.4-13.6 1.4-2.2 0.1-17.7-3.2-2.4-0.7-1.5-0.7-1.8-1.8-2.1-1.5-1.5-0.7-5.4-1.8-5.4-0.6-1.7 0.1-8.5 1.8-2.3-0.2-1.4-0.8-2.9-2.4-1.5-0.4-13.8-0.7-7.2 0.6-2.1 0.7-2 3.2-3.4-1.1-8.1-3.7-2-1.2-0.9-1.4-0.2-1.9 1.9-2.7 2.3-2.6 0.9-1.6 0.4-1.4-0.4-2-0.4-0.8-1.2-1.1-1.5-0.7-1.2-1.1-0.3-0.7 0.3-2.8 0.5-1.9 0-1.5-0.9-1.2-1.3-1-1.6-0.7-0.6-0.5-0.6-1.8-0.3-2 0.5-2.7 0.1-4.2-0.5-1.9-1.1-1.1-2.3-0.8-0.6-0.4-1.3-1.3-0.1-0.8 0.7-3.8 1-2.6 1.5-2.4 3-1.7 39.1-11.2 1.5 1 1.9 1.2 1.4 0.5 2.6 0.2 2.4-0.3 2.5-0.9 1.4 0.3 5.5 4.4 0.7 0.4 2.7 1.1 1 0.5 0.9 1.7 0.2 1.9 0.8 1.5 0.7 0.5 1.9 0.7 1.4 0.2 2.1-0.1 1.9-0.5 7.8-4.1 1.3-1 0.7-2.1z" name="Diourbel">
                        </path>
                    </a>
                    <?php
                    $fatick = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Fatick' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $fatick->execute();
                    $fatick_count = $fatick->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Fatick" xlink:title="Fatick : <?= $fatick_count ?> annonce(s)">
                        <path id="region-fatick" d="M236.1 523l-6.6 0-70.6-0.3-1.6-2.4-0.8-1.8 0.1-4.7 2.8-2.6 4.1-2.1 4.1-3.2-0.9-0.5-1.7-1.3-0.8-0.4 2-2 1.5-2.5-0.2-2.1-3.3-0.4 0.4 2.7-0.8 3.3-1.7 2.2-2.4-0.2-1.1 3.5-2.5 2.4-3.2 0.9-3.1-1-2.9-3-0.7-3 1.4-6.6 0.3-4.1 0.4-1.7 1.5-2.2 5.7-6.9 1-2.3 1 0.6 2.5 1.2 0.6-0.2-0.9-2.8 5.7-1 0.2 3.3 1.2 3.1 1.8 1.9 2.4-0.4-1.2-3.8-0.3-4.2-0.7-3.4-2.4-1.2 0.8-2.2 3.5-15.6 0.3-2.7-3.5 5.2-1.5 3.3-1.3 6.9-1.7 4.1-2.1 2.8-2.2-0.6-1.2 0-1.6 2.2-2.9 0.9-3.3 0.4-3.2 1-1.7 1.5-0.6 1.4-0.2 1.4-0.9 1.6-0.9 0.8-1.8 1-1.1 1-1.6 3-1.2 1.1-1.7-0.7-0.5-1.7 0-2-0.3-1.8-1.5-0.7-2-1.5-0.9-3.3 0.2-3.5 1.2-2.1-1-2.3-0.7-2.6-0.6-5.4 0.2-2.8 0.6-1.7 1-1.1 3.7-2.9 1.9-0.8 2.1-0.1 4.7 0.6 2.3 0.7 1.5 1.3-0.2 2.3 2.3-2.1 1.8-2.5 2.3-1.3 3.6 1.3 0-3.7 1.2-1.6 2.1-1.1 2.2-1.7-2 0.7-2.2 0.5-2-0.4-1.6-1.8 7.3-4.6 2.7-2.4 4.2-5.2 2.3-2 5.2-1.5 2.5-3.2 1.9-0.8 1.4 0.7 1.3 1.2 1.3 0.7 1.6-0.8 1-0.8 2.7-1.3 10.4 0.3 0.9 0.2 1.8 1.2 4.7 3 2.2 1.9 1.1 1.4 1.1 1.8 0.7 3.6 0.1 2.2-0.2 1.8-0.5 1.3-1.7 2.4-0.6 1.3 0.1 1.4 3.3 4.3 2 1.8 1.1 1.7 1.8 11.4-0.1 2.6-0.5 1.3-0.8 1.2-1.8 2.5-2.4 2-0.9 1.1-0.6 2.3-0.1 2.4 0.2 1.4 0.6 1.5 1.6 1.6 5.1 4.3 2.6 1.6 1.2 0.9 1 1.3 0.7 2.2 0.7 5.5 0.6 2.4 0.9 1.6 1.3 1.7 5.3 4.8 2.2 2.9 0.9 3.2 0.5 1.2z m106-165.4l-6 1.6-8.7 1.5-7.9 1.2-3.7 0.8-3.4 2.7-7.6 6.2-3.7 2-4.2 0.4-6.4 7.3-3.7 4.7-4.3 3.4-5.1 3.2-12.1-0.4-7.9-0.4-3.4 1.6-3 3.1-3.3 1.2-13.8-2.4-0.9-0.7 0-0.9-1.4-0.1-8.3 0.7-9.8 2.2-5.2 0.4-1.6 0.8-1.9 1.6-4.4 5.3-8.1 12.2-1.7 5.6-2.3 3.2-7.7-0.3-4.4-1.7 0.3-3.6-2.5 1.3-1 2.4 0.5 2.6 1.8 1.7-2 1.1-1.7-0.1-1.6-0.6-1.9-0.4-1.3 0.5-0.6 1.3-0.3 1.5-0.5 1.3-4.2 7.5-1.5 1.7-1.6 0.7-3.5 0.9-2 1.3-1.4 1.8-2 3.9-1.6 1.7-3.7 1.2-3.4-0.7-3.5-1.2-3.9-0.4 3.8-6.9 0.1-1.2 2.7-0.8 4.5-5-2.1 0.7-2.1 3.2-1.8 0.8-3.6 0.1-1.4 0.3-1.2 0.7 1.9 2.3-0.2 1.5-2.7 3.2-0.5 1.3-0.4 2.4-0.9 1.4-3.2 3.7-0.7 1.5-0.7 4.6 0.7 15.9-1 0-0.9-32.1-0.8-4.8-2.7-8.1-1.4-2.8 1.2-1.4 4.6-1.5 0.8-0.8 0.1-0.9-1.4-2.2 0-1.4 0.5-0.8 4.1-3.6 0.7-1.3 0.1-1-0.6-0.6-1.2-1.1-0.5-0.7 2.3-9.6 8.1-23.6 1.4-0.6 5.3-0.4 1.7-0.5 1.3-1.2 1.5-1.9 1.3-1.1 2.5-0.9 1.4-0.9 2.7-2.8 4.2-5.6 0.9-1.4 1.1-3.5 1.2-5 2-3.2 2.1-0.7 7.2-0.6 13.8 0.7 1.5 0.4 2.9 2.4 1.4 0.8 2.3 0.2 8.5-1.8 1.7-0.1 5.4 0.6 5.4 1.8 1.5 0.7 2.1 1.5 1.8 1.8 1.5 0.7 2.4 0.7 17.7 3.2 2.2-0.1 13.6-1.4 5.5-1.4 4-1.9 0.7-0.4 8.8-8.8 0.8-1.5 0.4-2 0.8-14.2 0.7-1.7 1.4-1.2 2.1-1.1 0.6-0.5 8.1 5.9 3.4-0.4 4.5-1.5 3 0.4 3.8 3.9 5.2 2.3 21.5 8.6 3.7 3.1 2.3 5.8z" name="Fatick">
                        </path>
                    </a>
                    <?php
                    $kaolack = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Kaolack' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $kaolack->execute();
                    $kaolack_count = $kaolack->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Kaolack" xlink:title="Kaolack : <?= $kaolack_count ?> annonce(s)">
                        <path id="region-kaolack" d="M348.1 491.9l-6.8 5.1-5.1 5.5-1.8 2.8-1.7 3.5-1.2 3.7-0.6 3.4-0.3 6.6-2.6 0.9-28.1-0.1-50.3-0.2-13.5-0.1-0.5-1.2-0.9-3.2-2.2-2.9-5.3-4.8-1.3-1.7-0.9-1.6-0.6-2.4-0.7-5.5-0.7-2.2-1-1.3-1.2-0.9-2.6-1.6-5.1-4.3-1.6-1.6-0.6-1.5-0.2-1.4 0.1-2.4 0.6-2.3 0.9-1.1 2.4-2 1.8-2.5 0.8-1.2 0.5-1.3 0.1-2.6-1.8-11.4-1.1-1.7-2-1.8-3.3-4.3-0.1-1.4 0.6-1.3 1.7-2.4 0.5-1.3 0.2-1.8-0.1-2.2-0.7-3.6-1.1-1.8-1.1-1.4-2.2-1.9-4.7-3-1.8-1.2-0.9-0.2-10.4-0.3 1.2-0.8-2.5-0.1 2.3-3.2 1.7-5.6 8.1-12.2 4.4-5.3 1.9-1.6 1.6-0.8 5.2-0.4 9.8-2.2 8.3-0.7 1.4 0.1 0 0.9 0.9 0.7 13.8 2.4 3.3-1.2 3-3.1 3.4-1.6 7.9 0.4 12.1 0.4 5.1-3.2-0.2 16.1-3 7.3-4.1 9.1-1.8 6.1 0 19.4 7.1 1.2 2.4 3.1 0.5 4.2 1.8 3.7 5.9 6 7 4.3 0.6 4.2-1.7 4.3 0 4.2 2.3 4.8 4.7 4.9 4.1 1.8 3-1.2 2.9-4.8 3.5-5.5 11.2 4.8 6.5 0.7 4.7 0 8.2 3.8z" name="Kaolack">
                        </path>
                    </a>
                    <?php
                    $louga = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Louga' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $louga->execute();
                    $louga_count = $louga->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Louga" xlink:title="Louga : <?= $louga_count ?> annonce(s)">
                        <path id="region-louga" d="M486.3 150.8l-12.9 12.2-6.5 4.3-8.2 3.1-4.7 1.8-1.2 30.6-5.9 9.1 27.1 14.1 13.5-1.9-5.3 23.2-3 18.3 7 3.5-12.8 3.8-18.3 2.5-11.1 4.2 4.7 16.5 7 15.8-5.9 12.2-7 4.8-2.4 13.4-6.2 4.7-3.7-5-2-1.6-2.7 0.6-2.7 1.3-14.4 8.9-3.1 1.2-3.8 0.9-5.5-0.5-24.7-5-8.2-3.1-12.9-7.9-5.9-3.5-4.2-4.7-1-3.6-0.8-10.1-1.1-1.5-1.4-0.3-2.1-0.2-10.7 1-1.5-0.2-2.4-0.9-3.6-2.3-4.5-0.4-8.6 0.3-4.1 1.3-2.9-2.3-0.8-2.2-0.1-2.2-0.2-0.9-0.9-1.4-2.8-1.9-4-1.8-0.7-0.5-1.1-1.2-0.9-2.6-1.1-1-1.8-0.8-1.1-1.2-0.5-1.9-0.1-2.2 0-1.5-2.4-0.5-39.8 0.3-3.7 0.9-5.2 4.6-3.6-1.9-3.6-1.4-1.7-1.1-0.8-0.8-1.1-1.7-0.9-2.4-0.5-3.1-0.7-1.7-0.9-1.4-4.7-5.8-0.9-1.4-1.6-4.1-0.5-3.1 0.3-2.2 0.3-4.2-0.4-2.3-0.7-1.7-1.1-1.8-1.4-3.2-1.1-1-0.9 0.4-2.1 1.4-0.8 0.1-0.7-0.4-0.6-1-0.5-2.1-0.9-8.1-0.6-1.5-1.6-1.1-2.4-0.1-2.5 0.7-1.9 0.1-7.7-1.9-1.2 0-1.7 0.7-1.1 1.2-1.4 2.1-1.6 1.8-1.8 2.8-1.1 1.1-2.5 3.4-1 2.5-0.4 1.8-0.6 1.7-0.9 1.4-7.3 7.7-0.9 1.4-2.1 2.5-1.3 1-1.6 0-0.8-0.5-0.7-0.9-0.8-1.4-0.2-2.8 0.8-1.9 0.4-1.4-0.7-1.8-1.1-1.3-0.9-0.6-2.6-1.3-1.4-0.9-1.2-1.1-2-2.7-1-2.1-1-1.4-1-0.7-1.9-0.8-1.3-0.4-1-1.8-0.4-3.2 0.8-7.1 1.2-4 2.9-5.8 0.7-3.2 0-2.1-0.8-1.9-0.8-1.2-4.9-4-0.7-0.4 10.6-14.3 21.2-35.8 0.7-1.7-0.2-1.7-0.8-1.8 26.4-0.6 3.1-0.6 3.1-1 3.5-2.6 2.2-0.9 2.8-0.4 2.5-0.1 2.3-0.4 1.2-1.3 0.7-1.2 2.1-5.6 1-2 1.7-1.4 6.9-3.6 0.9-0.7 0.4-0.8 0.5-1.8 0.8-1.4 1.1-1.3 5.6-4.7 0.9-0.5 30.6-17.4 1-0.7 1.1-1.4 1.7-2.9 0.7-1.7 1.2-1.1 3.1-1.6 2.7-2 1.6-1.8 2 1.3 3.4 3.1 33.3 38.4 1.8 1.2 25.5-1.8 1.1-11.3 92.8 0.2 2.7 1 13 7 8.5-0.6 18.3 12.9 8.2 12.2z" name="Louga">
                        </path>
                    </a>
                    <?php
                    $matam = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Matam' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $matam->execute();
                    $matam_count = $matam->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Matam" xlink:title="Matam : <?= $matam_count ?> annonce(s)">
                        <path id="region-matam" d="M786.4 270.7l0.4 1.2 17 22.8 1.1 2.7 0.8 3.9 0 1.2-0.3 1.5-12.4 31.5-13.3 20.4-2 2.2-2 1-24.3 3.1-7 0.1-43.8-8.1-1.7 0.6-1.3 0.7-42.5 30.7-1.8 0.9-44.4 0.7-8-1.3-70.5-26.9-2.7-1.5-2.9-2.3-1.5-3.2-7-6.6-6.7 2.1-2.5 1.3-2.9 2.6-4.8 5.8-7.8 5.5-20.1 4.9 0.3-2.5 0-1.9-0.2-2.1-1.1-1.1-2.6-1.1-26.3-7.8-4.4-2.1-3-2.6 6.2-4.7 2.4-13.4 7-4.8 5.9-12.2-7-15.8-4.7-16.5 11.1-4.2 18.3-2.5 12.8-3.8-7-3.5 3-18.3 5.3-23.2-13.5 1.9-27.1-14.1 5.9-9.1 1.2-30.6 4.7-1.8 8.2-3.1 6.5-4.3 12.9-12.2 7.1 9.8 13.5 7.3 12.3 6.1 6.5 4.9 24.1-18.9 25.9-21.4 18.2-16.6 2.4-6.1 16.4-6.7 6.8-14.2 0.8 0.5 1.6 0.6 0.8 0.6 0.4 0.9 0.6 0.4 1.4 0.7 1.5 1.1 1.1 0.2 1.1-0.3 4.4-2.4 0.9-0.2 3.1 0 1.8-0.4 4.9-2.2 8.5-1.8 3.1-1.2 2 0.2 0.3 2.4-2.7 5.1-0.3 2.6 1.6 1.1 6-2.3 2.4 0.1 0.8 0.9 1.3 2.3 0.8 0.9 4.5 3.1 0.9 1.2 0.4 1.3 0.2 2.9 0.2 1.3 2.3 5.7 1 1.8 1.2 1.6 1.5 1.5 4.1 3.1 0.9 1.3 0.4 1.4-0.1 1.4-0.7 2.9 0 1.4 0.4 1.1 0.7 1 2.9 3.5 1.5 2.6 0.7 2.8 0.1 3.3-1.3 4.3 0.2 1.4 0.9 1.2 1.1 0.9 2.5 1.4 1.3 1.1 1.1 1.1 1.8 2.8 0.7 1.4 0.2 1.2-0.3 1.2-2.4 3.9-0.6 1.4-0.2 1.4 0.2 1.5 1.6 4.2 2.4-0.1 4.9-0.9 2.3 0.2 1.2 0.4 3 2.2 1.2 0.5 3.7 1 2 1.2 1.8 1.6 1.1 2 0.4 2.4-0.9 6.3 0 1.5 0.3 1.4 0.6 1.5 0.9 0.8 5 1.2 2.3-0.3 2.5-1.5 2.1-1.7 2.4-1.4 2.5-0.3 2.6 1.2 1 1.2 0.5 1.5 0.7 4.7 0.5 1.1 1.6 2.2 0.8 1.2 0.3 1.3 0 5.7 0.6 2.7 1.3 2.6 2 2.1 9.7 6.7 2 2.1 1.1 2.8-0.9 2.3-2.7 0.5-5.5-0.6-1.7 1.2 1 2.1 3.7 3.8 1.4 1.1 1.5 0.5 1.5 0 3.5-0.7 1.7 0 1.6 0.5 1.5 1 0.8 1.2 0.4 1.3 0.1 1.3-0.9 4.3 0.1 1.3 0.7 2 4.1 1.3 6.1 5.9 4.4 1.9z" name="Matam">
                        </path>
                    </a>
                    <?php
                    $thies = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Thies' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $thies->execute();
                    $thies_count = $thies->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Thiès" xlink:title="Thiès : <?= $thies_count ?> annonce(s)">
                        <path id="region-thiès" d="M228.5 291.4l-0.7 2.1-1.3 1-7.8 4.1-1.9 0.5-2.1 0.1-1.4-0.2-1.9-0.7-0.7-0.5-0.8-1.5-0.2-1.9-0.9-1.7-1-0.5-2.7-1.1-0.7-0.4-5.5-4.4-1.4-0.3-2.5 0.9-2.4 0.3-2.6-0.2-1.4-0.5-1.9-1.2-1.5-1-39.1 11.2-3 1.7-1.5 2.4-1 2.6-0.7 3.8 0.1 0.8 1.3 1.3 0.6 0.4 2.3 0.8 1.1 1.1 0.5 1.9-0.1 4.2-0.5 2.7 0.3 2 0.6 1.8 0.6 0.5 1.6 0.7 1.3 1 0.9 1.2 0 1.5-0.5 1.9-0.3 2.8 0.3 0.7 1.2 1.1 1.5 0.7 1.2 1.1 0.4 0.8 0.4 2-0.4 1.4-0.9 1.6-2.3 2.6-1.9 2.7 0.2 1.9 0.9 1.4 2 1.2 8.1 3.7 3.4 1.1-1.2 5-1.1 3.5-0.9 1.4-4.2 5.6-2.7 2.8-1.4 0.9-2.5 0.9-1.3 1.1-1.5 1.9-1.3 1.2-1.7 0.5-5.3 0.4-1.4 0.6-8.1 23.6-2.3 9.6 0.5 0.7 1.2 1.1 0.6 0.6-0.1 1-0.7 1.3-4.1 3.6-0.5 0.8 0 1.4 1.4 2.2-0.1 0.9-0.8 0.8-4.6 1.5-1.2 1.4-1.6-3.1-1.4-1.8-2.1-1-4.3-1-1.6-1.4-0.8-2.5-1.4-9-1-2.8-1.4-2.1-3-3.2-1.4-0.8-1.1-0.2-0.7-0.7-0.2-2.2 0.2-1.7 0.8-3.3 0.2-1.9-0.8-2.8-2-2.9-5.1-5.2-11.6-5.5-1.7-1.9-1-2.2-5.7-8.7-4.3-11.5-1.7-2.4 3.1-23-0.2-1.6-0.5-1.5-2.6-4.3-0.5-1.5-0.1-4-0.1-0.9-1-3-3.3-7.6-0.2-0.2 1.4-0.6 5.6-4.6 25.8-30.9 5.1-7.7 11.3-12.7 22.5-40.2 0.7-0.8 0.7 0.4 4.9 4 0.8 1.2 0.8 1.9 0 2.1-0.7 3.2-2.9 5.8-1.2 4-0.8 7.1 0.4 3.2 1 1.8 1.3 0.4 1.9 0.8 1 0.7 1 1.4 1 2.1 2 2.7 1.2 1.1 1.4 0.9 2.6 1.3 0.9 0.6 1.1 1.3 0.7 1.8-0.4 1.4-0.8 1.9 0.2 2.8 0.8 1.4 0.7 0.9 0.8 0.5 1.6 0 1.3-1 2.1-2.5 0.9-1.4 7.3-7.7 0.9-1.4 0.6-1.7 0.4-1.8 1-2.5 2.5-3.4 1.1-1.1 1.8-2.8 1.6-1.8 1.4-2.1 1.1-1.2 1.7-0.7 1.2 0 7.7 1.9 1.9-0.1 2.5-0.7 2.4 0.1 1.6 1.1 0.6 1.5 0.9 8.1 0.5 2.1 0.6 1 0.7 0.4 0.8-0.1 2.1-1.4 0.9-0.4 1.1 1 1.4 3.2 1.1 1.8 0.7 1.7 0.4 2.3-0.3 4.2-0.3 2.2 0.5 3.1 1.6 4.1 0.9 1.4 4.7 5.8 0.9 1.4 0.7 1.7 0.5 3.1 0.9 2.4 1.1 1.7 0.8 0.8 1.7 1.1 3.6 1.4 3.6 1.9z" name="Thiès">
                        </path>
                    </a>
                    <?php
                    $kolda = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Kolda' AND  valider = 'oui' AND statuts = 'en cours' ");
                    $kolda->execute();
                    $kolda_count = $kolda->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Kolda" xlink:title="Kolda : <?= $kolda_count ?> annonce(s)">
                        <path id="region-kolda" d="M593.1 536.6l3.6-1.6 2.7-0.3 0.6-0.6 0.6-1.6 1.1-1.2 0.8-0.2 1.7 0.2 1.8 0 0.7 0.3 0.5 0.6-0.2 1-0.6 1.7 0 1.6-0.2 0.8-1.1 1.5-0.3 0.8 0 1 0.4 0.9 1.1 0.9 1 0.1 0.9-0.2 1.4-0.9 1.7-0.5 1.9 0.3 2.4 0.9 1.7 0.5 0.7 0.7-0.8 1.5-3 3-0.8 1.4-0.2 0.9 0 3-0.2 0.9-1.8 2.7-0.2 0.7 0.3 0.8 1 0.5 2.1 0.5 2-0.1 4-0.7 2.1-0.1 0.9 0.3 0.5 0.5 0 1.1-0.4 0.8-1.4 2-0.2 0.8 0.4 0.7 1.8 1.2 0.5 0.7 0.1 1.4-0.6 2.8 0.1 1 0.7 0.9 1.6 1.1 2.3 0.9 0.7 0.5 0.5 0.9 0.5 2.6 0.5 1 1.2 0.9 1 0.2 2 0 0.7 0.4 0.5 0.8 0.4 1.1 0.2 3.6-0.2 1.2 0.1 2.6-0.4 2 0.1 1 0.7 1.3 0.2 2.7 0.2 1.6 1.2 2.4 2.1 2.5 2.4 1.8-0.1 3.1 0.4 0.8 2.5 1.6 1.8 1.9 1.2 1.6 1.1 1.1 0.4 0.7-0.3 1-0.6 1.4 0.3 0.7 2.1 0.7 1 1 0.7 5.1-1.1 2.3 0.3 1 0.8 1.1 0.6 2.6 0.5 1.4 1.5 1.7 2.2 1.5 0.7 0.7 0.7 3.9 0.6 1.2-0.2 1.1-0.7 0.4-1.8-0.1-0.4 0.7 1.2 1.3 0 0.9-1.4 2.2-0.6 1.6 0.5 2.2 1.1 1.2 0.9 2.5 0.2 1-0.4 6.1-0.2 0.9-0.8 1.4-0.2 0.9 0.3 1 1.1 1.4 1.2 1 2.1 1 1.7 0.7 2.1 0.3 3.7 0 1.8-0.3 2-0.9 1-0.2 2.1 1 1.3 3.2-0.5 2.6-7.3-2-52.4-1.9-114.9-0.5-57.5-0.2-57.4-0.3-1.3-10.2 1.4-4.9 2.4-5.3 0-13.7-2.9-4.9-3.3-3.9-0.5-5.9 0.5-4.4-5.7-3.9-5.2-3.4-0.5-3.9-0.5-5.4-3.3-8.8-2.4-3.9-7.6-1.4-5.7-4-1-5.8 1.9-6.4 1.5-6.3 0.4-7.3 5.3-1 5.3-2 4.6-3.1 3.4-4.4 1-4.6 0.6-10.3 2.2-3.7 7.1-7.4 3.7-1.5 4.4 2.9 7.3 6.9 8.1 6 10.6 5.4 5.5 1.4 6.2 0.6 2.5 0.7 5.4 3.3 2.9 1 3.4 0.6 1.7 1.1 3.3 4.6 4.5 4.1 5.4 2.3 5.9 0.7 6-0.7 5.3-1.4 1.8 0.7 6.2 5.7 2.1 1.3 2.4 0.7 5.1 0.2 2.1 0.6 1.8 1.9 1.3 1.6 1.5 1.4 1.7 1.2 5.9 3.1 4.3 1.2 4.4 0.3 9.2-0.8 8.8 1.7 4.7-0.2 3.5-1.7 7.8-5.9 2.4-1.1 2.8 0 7-2.5 6.5-0.1 6.5-1.8 12.3-1 8-3.6 4.6-7 0.6-8.6-3.9-7.9-1.6-1.3-3.7-2.2-1.1-1z" name="Kolda">
                        </path>
                    </a>
                    <?php
                    $ziguinchor = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Ziguinchor' AND statuts = 'en cours' AND  valider = 'oui' ");
                    $ziguinchor->execute();
                    $ziguinchor_count = $ziguinchor->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Ziguinchor" xlink:title="Ziguinchor : <?= $ziguinchor_count ?> annonce(s)">
                        <path id="region-ziguinchor" d="M268.7 713.3l-1.6-0.1-12.8 0.9-3.2-0.5-10.1-3.4-5.7-0.6-12.3 2.2-2.5 1.3-1.4-0.2-3.5-1.4-1.7-0.3-1.7 0.3-11.2 6.1-13 7.1-4.9 2-8.2 0-8.4 2.2-3 0.1-22-1.5-5.9 1.5-3.7 2.5-1.1-2.1-0.8-2.2-0.7-3.4-1-1.1-2.4-1.7-3.8-3.7-1.6-2.1-0.7-2.1 0-7 0.4-1.5 1.6-1.4 0.3-1.5 1.2-1.8 8.1-4.8 3.5-0.2 5 0.5 5.4-3.4 1.8-1.5 0.9-1.3 0.7-1.4 1.1-1.6 6.2-4.6 3 3.5 2.3 6.3 2.2 1.5 0.1-2.6 1.7-2.1 2.8-0.8 3.2 0.7 5.4 3.1 4.9 1.4 5.4 2.5 2.8 0.3 3.2-1.6 3.9-4.8 2.9-1.6 3.7 0.2 3.2 1.2 3.2 0.3 3.7-2.3 1.9-0.8 1.3 1.5 0.9 2.1 1 1.2 12.6-4.7 2.9-0.7 3.9-0.3 2.5-0.7 2.1-1.5 2.4-1.3 3.6 0.2 2.8 1.5 4.3 3.4-0.1 1 0.4 4.4 2.3 4.9 3 4.3 1.6 3.6 5 7.4 0.7 1z m-22.4-47.6l-1 0 0 1.2-0.2 0.7-1.7 3.4-0.8 1.1-0.6 5.6-4.5 2.9-6.7 1.2-1.7 0.7-3.3 2.2-1 0.4-1.7-0.1-3.9-1.1-6.2 0-1.8 0.5-3.1 1.3-1.7 0.5-2 0-5.2-1.1-1.8 0.4-2.2 1.6-1.5 0.3-0.5 0.8-0.8 1.8-1.1 1.9-1.5 1.1-6.6-2.2-5.4-3.1-2.5-2.1-1.1-2.2-2.1-0.9-1.5-0.7-0.8-1.2 0.3-1.6 1-1.5 1.5-1.1 1.6-0.3 0-1.3-2.5 0-1.6-1.3-0.9-2-0.5-2.3-1.1 13.7-1.2 0-2.2-2.9-5.9-5.2-0.8-3.3-1.9 1.6-1.2 1.8-1.5 1.6-2.6 0.6-1.9-0.4-1.3-1.1-0.7-1.8 0.1-2.3 2.3-4.3 3.3-3.3 2.1-3.7-1-5.9-0.7 4.5-0.4 1.3-0.9 1.4-1.5 1.2-3.2 3-1.4 1.7-0.7 2.2-0.2 3.5 1.2 5.9-0.4 2.7-4.8 2.1-7.1 6-5.5 1.9-3-1.8-1.2-4.3-0.3-5.6 0.9-5.9 2.6-5.8 4.1-3.3 5.7 1.9 0.3-2.5-2.4-1.8-3.3-0.7-2.9 1-3.3 4.1-1.9 1.4-2-0.5 1-1.3 0.3-1.5-0.3-1.4-1-1.4 3.5-4.9 0.7-2.5-0.8-2.9-1.2 0-0.7 1.9-1.2 0.8-1-0.7-0.4-2.5 0.4-2 1-2.1 5.7-8.7 0.6-2.1-0.1-2.1-0.8-3.9-0.2-1.9 0.4-3.5 1.6-6.9 0.3-4.4-0.2-2.8-0.7-1.4 0.2-3.8 0.6-1.9 1.1-1.3 2.5-2.6 0.5-1.6 2.4-4 5.7-1.3 33.7 0.3 92 0.9-1.5 2.6-2.8 3.1-0.8 2 0.2 1.4 1.1 0.6 2.3 0.9 0.9 1.2 0 1.2-6.5 13.6-7.3 11.7-0.2 1.9 0.2 1.8 0.8 2.8-0.5 1.7-0.3 3.5-0.7 2-1.7 1.6-0.9 1.1-0.3 1-1.4 10.3-0.7 1.5-0.3 2.3 0.2 1.5z" name="Ziguinchor">
                        </path>
                    </a>
                    <?php
                    $tambacounda = $loginData->prepare("SELECT villes FROM annonces WHERE villes ='Tambacounda' AND statuts = 'en cours' AND  valider = 'oui' ");
                    $tambacounda->execute();
                    $tambacounda_count = $tambacounda->rowCount();
                    ?>
                    <a xlink:href="annonce_ville.php?ville=Tambacounda" xlink:title="Tambacounda : <?= $tambacounda_count ?> annonce(s)">
                        <path id="region-tambacounda" d="M914.4 556.9l-9.5 1.7-5.7 1.5-4.3 4.9-4.2 2.9-3.4 0-0.9-3.9-1-3.4-4.2-1.5-5.8-1.4-4.7-3-4.8-2.4-4.2-3.4-4.8-3-3.8 1.5 0 3.9-2.4 2.5 1 2.9 4.7 5.9 1 3.9-2.4 2.9-4.3 0-5.2-1-1.9 1-1 3.9-1.4 2-1 2.9-1.9 0.5-1.9-1.5-2.3-2.9-3.8-1-4.3 1-2.4 2-1 2.4-3.3 0.5-1.9 2.4-0.5 3.5-1.9 3.4-2.8 1.9-5.2 1.5-3.9-0.5-4.7-2.9-1.9 1.5-2.9 1.4-3.3 0-3.3 0.5-2.4 2 0 3.9 1 3.9-2.4 2.9-3.8 2.5-1.5 2.9 0 2.9-2.3 0.5-2.4-1-3.3-0.5-1.5 1.5-0.4 2.9-2.4 1-2.9 0-1.4 1.5 0 1.9-1.4 2.5-3.4-1-4.2-2.9-3.8-3.9-2.4 0-2.9-3-3.3-1.4-9 0-6.7 3.4-3.3 0-1.5 1.5-1.4 2.4-2.8 0-2.9-2.4-4.3-1.5-4.7-0.5-2.4 0-4.6 1.8-7.1 2.1-3.2-0.9-3.1-3.6-0.8-4.3 0.3-5-0.6-4.1-3.3-1.5 0-1 6.6-2.4-2.1-1.8 0.3-2.2 0.7-2.3-0.6-2.2-1-1.7 0.6-1.5-0.1-0.8-0.8-0.6-2.2-1.3-0.9-1.6-2.2 0.1-0.6-0.6-0.1-1.4-1.1-2.6-0.1-2.5 0.7-1.4 1.3-1.5 1.6-2.7-1.5-2.6-1.5-0.3-1.7 1-2 0.9-6.2-1.2-6.6 0-1.5 0.9-1.4 3.9-2.1 0.9 1.1-3.6-2.1-0.7-3.2 0.9-2.4 1.2-0.8 1-0.9 2-1.6 0.3-1.9-0.6-1-1.2 0.5-2.8-2.7 2-0.1 8.9-3.8 1.8 0.1 1.5-2 0-1-0.2-1.2-0.9-0.5-1-0.5-2.6-0.5-0.9-0.7-0.5-2.3-0.9-1.6-1.1-0.7-0.9-0.1-1 0.6-2.8-0.1-1.4-0.5-0.7-1.8-1.2-0.4-0.7 0.2-0.8 1.4-2 0.4-0.8 0-1.1-0.5-0.5-0.9-0.3-2.1 0.1-4 0.7-2 0.1-2.1-0.5-1-0.5-0.3-0.8 0.2-0.7 1.8-2.7 0.2-0.9 0-3 0.2-0.9 0.8-1.4 3-3 0.8-1.5-0.7-0.7-1.7-0.5-2.4-0.9-1.9-0.3-1.7 0.5-1.4 0.9-0.9 0.2-1-0.1-1.1-0.9-0.4-0.9 0-1 0.3-0.8 1.1-1.5 0.2-0.8 0-1.6 0.6-1.7 0.2-1-0.5-0.6-0.7-0.3-1.8 0-1.7-0.2-0.8 0.2-1.1 1.2-0.6 1.6-0.6 0.6-2.7 0.3-3.6 1.6-1.2-1.7-1-3.2-0.9-1.4-2.7-2.2-3.9-2-4.1-1.5-3.4-0.6-2.2 0.4-3.3 1.9-1.9 0.9-1.7 0.3-2.8-0.3-1.7 0.1-3.3 0.8-7.5 3.9-9.4 2.1-3 1.3-9 5.7-9.5 3.4-2.8 0.7-3-0.4-3.9-1.9-13.1-9.4-1.6-1.8-1.1-2.2-2.1-7.3-1.6-3.2-2.2-2.7-3.1-2.6-6.9-3.2-6.7-0.5-6.6 1.7-9.9 5.6-2 0.7-2.3-0.8-6.7-4.1-1.1-1.3-3.1-10.8-1.5-3.1-2-2.8-2.7-2.2 0.7-2.2 2.9-5.1 1.9-2.7 2.3-2.4 1.6-0.7 2-0.3 3-0.3 1.6-0.7 7.5-1.9 0.7-0.4 3.8-3.1 9.6-9.2 0.4-0.8 0.7-3.2-0.1-3 0.6-2.9 0.9-0.7 3-1.3 1.3-2.2 1.5-6.9 0-2.8-0.4-3.3-1.4-7.4-0.8-12.7-0.8-3-2.1-3-3.7-10.9 0.2-31.6 20.1-4.9 7.8-5.5 4.8-5.8 2.9-2.6 2.5-1.3 6.7-2.1 7 6.6 1.5 3.2 2.9 2.3 2.7 1.5 70.5 26.9 8 1.3 44.4-0.7 1.8-0.9 42.5-30.7 1.3-0.7 1.7-0.6 43.8 8.1 7-0.1 24.3-3.1 2-1 2-2.2 13.3-20.4 12.4-31.5 0.3-1.5 0-1.2-0.8-3.9-1.1-2.7-17-22.8-0.4-1.2 1.7-0.3 5.1-1.5 2.5-0.4 1.5 0.5 1.3 1.3 2.1 2.7 8.9 5.3 2.8 2.1 1.8 1.1 3.8 0.8 1.7 1 1.4 1.6 0.8 1.6 3.7 13.4 0.1 1.8 2.3 1.4 5.4 6.5 2.9 2.4 10.2 4.9 9 7.1 1.2 4.9 3.2 2.9 1 2.3 1.3 1.9 2.4 1.1 2.6 0.5 1.8 0.1-0.9 2.1-0.7 1.2-0.3 1.1 0.4 1.8 1.1 1 1.7 0.4 1.2 1-0.1 2.8-0.9 1.5-3.2 3-1.2 1.8-0.3 1.7-0.2 2-0.4 1.9-1.2 1-3.1 1.9-1 2.9 0.4 3.5 1.9 7.3 0.4 3.4-0.3 7.3 2.1 0.4 15.1 5.6 1.1 2.2-0.7 2.1-2.3 0.9 1.3 2.3 1.5 2.1 2 1.7 6.4 2.3 2.3 1.5 1.6 2.5 6 14.1 0.3 3.7-1.2 6.7-3.6 12.9 0 6.9 1.6 4.3 2.6 2.7 3 2.3 2.9 3.4 1 3.2-0.1 3.4-0.9 6.7-2.6 7.5-5.4 5.6-13.9 7.8 2.3 1.9 2.2 3.3 3.3 6.5 2 6 3.6 5.7 3 3.4 9.3 6.8 1.1 1.2 1.4 2.5 0.9 1.1 1.7 0.8 1.5 0.2 1.3 0.6 1.1 1.9-0.3 3-2.3 8.9z" name="Tambacounda">
                        </path>
                    </a>
                    <circle cx="602.2" cy="515.6" id="0">
                    </circle>
                    <circle cx="168.9" cy="204.9" id="1">
                    </circle>
                    <circle cx="158.1" cy="210.6" id="2">
                    </circle>
                </svg>
            </div>
            <!-- liste ville -->
            <div class="filtre-ville map__list  d-none d-lg-block my-2 col-2" id="filtre-ville">
                <ul>

                    <li>
                        <a id="list-dakar" href="annonce_ville.php?ville=Dakar">Dakar</a>
                    </li>
                    <li>
                        <a id="list-diourbel" href="annonce_ville.php?ville=Diourbel">Diourbel</a>
                    </li>
                    <li>
                        <a id="list-fatick" href="annonce_ville.php?ville=Fatick">Fatick</a>
                    </li>
                    <li>
                        <a id="list-kaffrine" href="annonce_ville.php?ville=Kaffrine">Kaffrine</a>
                    </li>
                    <li>
                        <a id="list-kedougou" href="annonce_ville.php?ville=Kédougou">Kédougou</a>
                    </li>
                    <li>
                        <a id="list-kaolack" href="annonce_ville.php?ville=Kaolack">Kaolack</a>
                    </li>
                    <li>
                        <a id="list-kolda" href="annonce_ville.php?ville=Kolda">Kolda</a>
                    </li>
                    <li>
                        <a id="list-louga" href="annonce_ville.php?ville=Louga">Louga</a>
                    </li>
                    <li>
                        <a id="list-matam" href="annonce_ville.php?ville=Matam">Matam</a>
                    </li>
                    <li>
                        <a id="list-sédhiou" href="annonce_ville.php?ville=Sédhiou">Sédhiou</a>
                    </li>
                    <li>
                        <a id="list-saint-Louis" href="annonce_ville.php?ville=Saint-Louis">Saint-Louis</a>
                    </li>
                    <li>
                        <a id="list-tambacounda" href="annonce_ville.php?ville=Tambacounda">Tambacounda</a>
                    </li>
                    <li>
                        <a id="list-thiès" href="annonce_ville.php?ville=Thiès">Thiès</a>
                    </li>
                    <li>
                        <a id="list-ziguinchor" href="annonce_ville.php?ville=Ziguinchor">Ziguinchor</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="filter-map.js"></script>