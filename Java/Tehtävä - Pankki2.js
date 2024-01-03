class Pankkitili {
  constructor(tilinumero) {
    this.tilinumero = tilinumero;
    this.saldo = 0;
    this.tapahtumahistoria = [];
    this.luottoraja = 0;
  }

  teeTalletus(summa) {
    const tapahtuma = {
      päivämäärä: new Date(),
      tapahtuma: "Talletus",
      summa: summa,
      saldoEnnen: this.saldo
    };

    this.saldo += summa;
    this.tapahtumahistoria.push(tapahtuma);
    console.log(`Talletus tehty. Uusi saldo: ${this.saldo}`);
  }

  teeNosto(summa) {
    if (summa > this.saldo) {
      console.log("Ei tarpeeksi saldoa nostoon.");
    } else {
      const tapahtuma = {
        päivämäärä: new Date(),
        tapahtuma: "Nosto",
        summa: summa,
        saldoEnnen: this.saldo
      };

      this.saldo -= summa;
      this.tapahtumahistoria.push(tapahtuma);
      console.log(`Nosto tehty. Uusi saldo: ${this.saldo}`);
    }
  }

  lisääKorko(korkoprosentti) {
    const korko = (this.saldo * korkoprosentti) / 100;
    this.saldo += korko;
    console.log(`Korko lisätty. Uusi saldo: ${this.saldo}`);
  }

  tarkistaLuottoraja(nettoTulot) {
    const maksimiLuottoraja = nettoTulot * 0.25;

    if (this.luottoraja > maksimiLuottoraja) {
      console.log(`Luottoraja on jo asetettu ja se on suurempi kuin sallittu maksimi.`);
    } else {
      this.luottoraja = maksimiLuottoraja;
      console.log(`Luottoraja asetettu: ${this.luottoraja}`);
    }
  }

  näytäTilinTiedot() {
    console.log(`
      Tilinumero: ${this.tilinumero}
      Saldo: ${this.saldo}
      Luottoraja: ${this.luottoraja}
    `);
  }

  näytäTapahtumahistoria() {
    console.log("Tapahtumahistoria:");
    this.tapahtumahistoria.forEach(tapahtuma => {
      console.log(`
        Päivämäärä: ${tapahtuma.päivämäärä}
        Tapahtuma: ${tapahtuma.tapahtuma}
        Summa: ${tapahtuma.summa}
        Saldo ennen tapahtumaa: ${tapahtuma.saldoEnnen}
      `);
    });
  }
}


const asiakkaanTili = new Pankkitili("FI123456789");
asiakkaanTili.teeTalletus(100);
asiakkaanTili.teeNosto(50);
asiakkaanTili.lisääKorko(1);
asiakkaanTili.tarkistaLuottoraja(2000); 
asiakkaanTili.näytäTilinTiedot();
asiakkaanTili.näytäTapahtumahistoria();
