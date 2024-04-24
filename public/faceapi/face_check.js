let video = document.getElementById('videoElement');
let canvas = document.createElement('canvas');
let context = canvas.getContext('2d');
let photoDisplay = document.getElementById('photoDisplay');
let capturedPhoto = document.getElementById('capturedPhoto');
let faceMatcher;
let href;
let image;
async function init() {
    await Promise.all([
        faceapi.loadSsdMobilenetv1Model("faceapi/model-faceapi"),
        faceapi.loadFaceRecognitionModel("faceapi/model-faceapi"),
        faceapi.loadFaceLandmarkModel("faceapi/model-faceapi")
    ]);

    Toastify({
        text: "Tải xong model nhận diện!",
    }).showToast();
}

init();
function startCamera(local, dataimage) {
    href = local;
    image = dataimage;
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
            video.play();
            document.getElementById('cameraOutput').style.display = 'block';
        })
        .catch(function (err) {
            console.log("Lỗi truy cập camera: " + err);
        });
}


function stopCamera() {

    const stream = videoElement.srcObject;
    if (stream) {

        const tracks = stream.getTracks();
        tracks.forEach(track => {
            track.stop();
        });

        videoElement.srcObject = null;
    }
}


function capturePhotoForRecognition() {
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
    document.getElementById('cameraOutput').style.display = 'none';

    stopCamera();

    const imageDataURL = canvas.toDataURL('image/png');
    fetch(imageDataURL)
        .then(res => res.blob())
        .then(blob => {
            recognizeFace(blob);
        })
        .catch(error => {
            console.error('Lỗi khi chuyển đổi URL dữ liệu sang Blob:', error);
        });

}

async function recognizeFace(imageDataURL) {
    const imageFromCamera = await faceapi.bufferToImage(imageDataURL);
    const canvas = faceapi.createCanvasFromMedia(imageFromCamera);
    //document.querySelector("#loading").remove();
    // container.innerHTML = "";

    // container.append(imageFromCamera);
    // container.append(canvas);

    const size = {
        width: imageFromCamera.width,
        height: imageFromCamera.height,
    };

    faceapi.matchDimensions(canvas, size);

    
    //const imageURL = 'data/Takizawa Laura/2.jpeg';
    const imageURL = 'uploads/'+image; 
    const imageFromPath = await faceapi.fetchImage(imageURL);

    // Nhận diện khuôn mặt và so sánh ảnh từ camera với ảnh từ đường dẫn
    const detectionsFromCamera = await faceapi.detectAllFaces(imageFromCamera)
        .withFaceLandmarks()
        .withFaceDescriptors();
    const detectionsFromPath = await faceapi.detectAllFaces(imageFromPath)
        .withFaceLandmarks()
        .withFaceDescriptors();

    const faceMatcher = new faceapi.FaceMatcher(detectionsFromPath);

    const matches = detectionsFromCamera.map(detection => {
        return faceMatcher.findBestMatch(detection.descriptor);
    });
    // if (!detectionsFromCamera || !detectionsFromCamera.descriptor) {
    //     alert('Không thể nhận diện khuôn mặt từ ảnh camera hoặc dữ liệu không hợp lệ.');
    //     return;
    // }
    

    // const faceMatcher = new faceapi.FaceMatcher(detectionsFromPath);

    // const match = faceMatcher.findBestMatch(detectionsFromCamera.descriptor);

    let matchFound = false;
    matches.forEach(match => {
        if (match._label === 'unknown') {
            // Không trùng khớp
            matchFound = false;
        } else {
            // Trùng khớp
            matchFound = true;
        }
    });

    if (matchFound) {
        alert('Thành công: Ảnh từ camera trùng khớp.');
        window.location.href = href;
    } else {
        alert('Không trùng khớp: Ảnh từ camera không trùng khớp.');
    }

    //container.innerHTML = "";
}


video.addEventListener('playing', ()=> {
    const canvas = faceapi.createCanvasFromMedia(video);


    document.querySelector('#cameraOutput').append(canvas);

    const size = {
        width: video.videoWidth,
        height: video.videoHeight,
    };

    faceapi.matchDimensions(canvas, size);
    
    setInterval(async ()=>{
        const detections = await faceapi
        .detectAllFaces(video)
        .withFaceLandmarks()
        .withFaceDescriptors();
        const resizedDetections = faceapi.resizeResults(detections, size);


        canvas.getContext('2d').clearRect(0, 0, size.width, size.height);

        faceapi.draw.drawDetections(canvas, resizedDetections);

    }, 300);
    
    
});

