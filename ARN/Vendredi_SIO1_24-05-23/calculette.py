#! /usr/bin/env python
# -*- coding:Utf8 -*-

from tkinter import *
from math import *

# définition de l'action à effectuer si l'utilisateur actionne
# la touche "enter" alors qu'il édite le champ d'entrée :

def evaluate(event):
    chaine.configure(text = "Résultat = " + str(eval(entree.get())))

# ----- Programme principal : -----

fenetre = Tk()

entree = Entry(fenetre, bd=2, relief =GROOVE)
entree.bind("<Return>",evaluate)
entree.pack(padx =10, pady =5)

chaine = Label(fenetre)
chaine.pack(padx =10, pady =5)

fenetre.mainloop()
