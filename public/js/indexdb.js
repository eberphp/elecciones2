let dbs ;
let inoDb;
// check for IndexedDB support
if (!window.indexedDB) {
    console.log(`Your browser doesn't support IndexedDB`);
    // return;
}

// open the CRM database with the version 1
const request = indexedDB.open('CRM', 1);

inoDb = request;
// create the Contacts object store and indexes
request.onupgradeneeded = (event) => {
    let db = event.target.result;

    // create the Contacts object store 
    // with auto-increment id
    let store = db.createObjectStore('Votos', {
        autoIncrement: true
    });

    // create an index on the email property
    let index = store.createIndex('voto', 'voto', {
        unique: true
    });
};

// handle the error event
request.onerror = (event) => {
    console.error(`Database error: ${event.target.errorCode}`);
};

// handle the success event
request.onsuccess = (event) => {
     const db = event.target.result;

    dbs = event;
    // get contact by id 1
    // getContactById(db, 1);

    // get contact by email
    getContactByVoto(db, 'Si');

    // get all contacts
    // getAllContacts(db);

    // deleteContact(db, 1);

    console.log(inoDb);

};

function insertContact(db, contact) {
    // create a new transaction
    const txn = db.transaction('Votos', 'readwrite');

    // get the Contacts object store
    const store = txn.objectStore('Votos');
    //
    let query = store.put(contact);

    // handle success case
    query.onsuccess = function (event) {
        console.log(event);
    };

    // handle the error case
    query.onerror = function (event) {
        console.log(event.target.errorCode);
    }

    // close the database once the 
    // transaction completes
    txn.oncomplete = function () {
        db.close();
    };
}


function getContactByVoto(db, voto) {
    const txn = db.transaction('Votos', 'readonly');
    const store = txn.objectStore('Votos');

    // get the index from the Object Store
    const index = store.index('voto');
    // query by indexes
    let query = index.get(voto);

    // return the result object on success
    query.onsuccess = (event) => {
        if (query.result !== undefined) {
            if (query.result.voto == 'Si') {
                location.href =
                    "{{ route('Votos.grafico.publico', ['encuesta' => Crypt::encryptString($encuesta->idEncuesta)]) }}"
            }
        }
    };

    query.onerror = (event) => {
        console.log(event.target.errorCode);
    }

    // close the database connection
    txn.oncomplete = function () {
        db.close();
    };
}
