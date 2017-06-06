var assert = chai.assert;

var expectedID = 1;
testBasicAPIs('test', {
      attraction: {
        _id: undefined,
        name: "Ocean Ark",
        url: "ocean-ark.hk",
        desc: "Oh Hark!",
        photo: "img/ocean-ark.jpg"
      }
    }
    , expectedID);

