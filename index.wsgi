from bottle import Bottle, run

import sae
import os
import sae.const
from sae.ext.storage import monkey
monkey.patch_all()
import cStringIO

app = Bottle()

@app.route('/')
def hello():
    a = sae.const.MYSQL_DB
    output = cStringIO.StringIO()
    output.write('First line.\n')
    output.write('Second line.\n')
    contents = output.getvalue()
    # write content to storage bucket test
    
    f = open('/s/test/example.txt', 'w')
    f.write(contents)
    f.close()
        
    return contents

application = sae.create_wsgi_app(app)
