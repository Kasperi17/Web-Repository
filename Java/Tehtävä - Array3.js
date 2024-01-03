const lampotilat = [18, 13, 21.3, 17, 14, 25.3, 17];

const paivat = ["Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai", "Sunnuntai"];

for (let i = 0; i < paivat.length; i++) {
    const keskiarvo = lampotilat[i];
    console.log(`${paivat[i]} ${keskiarvo} astetta`);
}
