class Pankki {
    constructor(tilinumero) {
      this.tilinumero = tilinumero;
      this.saldo = 0;
      this.historia = [];
    }
  
    talleta(summa) {
      const tapahtuma = {
        päivämäärä: new Date(),
        tapahtuma: "Talletus",
        summa: summa,
        saldoEnnen: this.saldo
      };
  
      this.saldo += summa;
      this.historia.push(tapahtuma);
      console.log(`Talletus tehty. Uusi saldo: ${this.saldo}`);
    }
  
    nosta(summa) {
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
        this.historia.push(tapahtuma);
        console.log(`Nosto tehty. Uusi saldo: ${this.saldo}`);
      }
    }
  
    näytäTiedot() {
      console.log(`
        Tilinumero: ${this.tilinumero}
        Saldo: ${this.saldo}
      `);
    }
  
    näytäHistoria() {
      console.log("Tapahtumahistoria:");
      this.historia.forEach(tapahtuma => {
        console.log(`
          Päivämäärä: ${tapahtuma.päivämäärä}
          Tapahtuma: ${tapahtuma.tapahtuma}
          Summa: ${tapahtuma.summa}
          Saldo ennen tapahtumaa: ${tapahtuma.saldoEnnen}
        `);
      });
    }
  }
  
  const pankkitili = new Pankki("FI123456789");
  pankkitili.talleta(100);
  pankkitili.nosta(50);
  pankkitili.näytäTiedot();
  pankkitili.näytäHistoria();