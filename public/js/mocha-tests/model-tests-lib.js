function testBasicAPIs(modelName, postData, expectedID) {
    expectedID = (expectedID === undefined) ? getRandomIntID() : expectedID;
    describe('Basic ' + modelName + 's API', function () {
        testDeleteAll(modelName);

        postData[modelName]._id = expectedID;
        console.log(postData);
        testPost(modelName, postData);

        testGetAll(modelName, expectedID)
    })
}

function testPost(modelName, data) {
    describe('POST /' + modelName + 's', function () {
        it('Should add a new ' + modelName, function (done) {
            $.post(baseURL + '/' + modelName + 's', data, function (data) {
                assert.equal(data.success, true, 'data.success equals true');
                done()
            })
                .fail(function (jqXHR) {
                    done(new Error(jqXHR.responseText))
                })
        })
    });
}

function testGetAll(modelName, expectedID) {
    describe('GET /' + modelName + 's' + '/all', function () {
        it('Should get an array with one ' + modelName, function (done) {
            $.get(baseURL + '/' + modelName + 's/all', function (data) { //success
                console.log('returned data');
                console.log(data);
                assert.equal(data[0]._id, expectedID, '_id equals modelName' + 'ID');
                done()
            })
                .fail(function (jqXHR) {
                    done(new Error(jqXHR.responseText))
                })
        });
    })
}

function testDeleteAll(modelName) {
    describe('DELETE /' + modelName + 's/all', function () {
        it('Should delete all ' + modelName + 's', function (done) {
            $.ajax({
                url: baseURL + '/' + modelName + 's/all',
                method: 'DELETE',
                success: function (data) {
                    assert.equal(data.success, true, 'data.success is true');
                    done()
                }
            })
                .fail(function (jqXHR) {
                    done(new Error(jqXHR.responseText));
                })
        })
    });
}

function getRandomIntID() {
    return Math.floor(Math.random() * 100000)
}
