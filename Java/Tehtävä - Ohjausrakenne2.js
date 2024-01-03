const nykyinenAika = new Date();

const tunnit = nykyinenAika.getHours();

if (tunnit >= 7 && tunnit <= 11) {
    console.log("Hyvää huomenta");
} else if (tunnit >= 12 && tunnit <= 18) {
    console.log("Hyvää päivää");
} else if (tunnit >= 19 && tunnit <= 22) {
    console.log("Hyvää iltaa");
} else {
    console.log("Hyvää yötä");
}

