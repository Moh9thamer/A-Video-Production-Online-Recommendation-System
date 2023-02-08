import spacy
import sys
import re
from collections import Counter
from string import punctuation
nlp = spacy.load("en_core_web_sm")
def get_hotwords(text):
    result = []
    pos_tag = ['PROPN', 'ADJ', 'NOUN']
    doc = nlp(text.lower())
    for token in doc:
        if(token.text in nlp.Defaults.stop_words or token.text in punctuation):
            continue
        if(token.pos_ in pos_tag):
            result.append(token.text)
    return result


new_text = sys.argv[1].strip()



output = set(get_hotwords(new_text))
most_common_list = Counter(output).most_common(10)

a=[]
for item in most_common_list:
    a.append(item[0])

print(a)







