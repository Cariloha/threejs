
//Scene
const scene = new THREE.Scene();



//Red cube
const geometry = new THREE.BoxGeometry(1, 1, 1);
const material = new THREE.MeshBasicMaterial({color: '#ff0000'});
const mesh = new THREE.Mesh(geometry, material);
// mesh.position.x = 0.7;
// mesh.position.y = -0.6;
// mesh.position.z = 1;

scene.add(mesh);

//Scale
// mesh.scale.x = 2;
// mesh.scale.y = 0.5;
// mesh.scale.x = 0.5;

//Rotate has two ways of working: rotation or quaternion
// mesh.rotation.reorder('YXZ'); //This goes before changing the rotation
// mesh.rotation.x = Math.PI * 0.25;
// mesh.rotation.y = Math.PI * 0.25;


//Axes helper
const axesHelper = new THREE.AxesHelper();
scene.add(axesHelper);

//Sizes 
const sizes = {
    width: 800,
    height: 600
}

//Camera
const camera = new THREE.PerspectiveCamera(75, sizes.width / sizes.height) //field of view, aspect ratio (width / height), 
// camera.position.x = 1;
// camera.position.y = 1;
camera.position.z = 3;

scene.add(camera);

camera.lookAt(mesh.position);

//Renderer
const canvas = document.querySelector('.webgl');
const renderer = new THREE.WebGLRenderer({
    canvas : canvas
})
renderer.setSize(sizes.width, sizes.height);

// renderer.render(scene, camera);

// Time

let time = Date.now();

//Animations

const tick = () => 
{

    //Time
    const currentTime = Date.now();
    const deltaTime = currentTime - time;
    time = currentTime;

    //To move in circle:
    camera.position.y = Math.sin(0.001 * time);
    camera.position.x = Math.cos(0.001 * time);
    camera.lookAt(mesh.position);

    // mesh.rotation.y += 0.01 * deltaTime;

    renderer.render(scene, camera);
    window.requestAnimationFrame(tick)

    
}

tick();