class Pelaaja {
    constructor(nimi) {
      this.nimi = nimi;
      this.pisteet = 0;
      this.elämät = 3;
      this.taso = 1;
      this.kokemuspisteet = 0;
    }
  
    pelaa(arvo) {
      this.pisteet += arvo;
      this.kokemuspisteet += arvo / 10;
      console.log(`${this.nimi} pelasi. Pisteet: ${this.pisteet}, Kokemuspisteet: ${this.kokemuspisteet}`);
    }
  
    häviä() {
      this.elämät--;
      console.log(`${this.nimi} hävisi. Elämät jäljellä: ${this.elämät}`);
    }
  
    nouseTasolle() {
        const tarvittavatKokemuspisteet = this.taso * 100;
        if (this.kokemuspisteet >= tarvittavatKokemuspisteet) {
          this.taso++;
          this.kokemuspisteet = 0;
          console.log(`${this.nimi} nousi tasolle ${this.taso}!`);
        } else {
          console.log(`${this.nimi} ei vielä tarpeeksi kokemuspisteitä tasolle ${this.taso} siirtymiseen.`);
        }
      }
  
    näytäTiedot() {
      console.log(`
        Nimi: ${this.nimi}
        Pisteet: ${this.pisteet}
        Elämät: ${this.elämät}
        Taso: ${this.taso}
        Kokemuspisteet: ${this.kokemuspisteet}
      `);
    }
  }
  

  const pelaaja1 = new Pelaaja("Pelaaja1");
  pelaaja1.pelaa(1000);
  pelaaja1.häviä();
  pelaaja1.näytäTiedot();
  pelaaja1.pelaa(120);
  pelaaja1.nouseTasolle(3);
  pelaaja1.näytäTiedot();
  