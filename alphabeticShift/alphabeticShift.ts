function alphabeticShift(inputString: string): string {

	const listed = inputString.split('');
	const shifted = [];
	let newString = "";
	
	//console.log(listed);

	for(a=0; a<listed.length; a++) {
		if(listed[a].charCodeAt(0)!== 122) {
			shifted.push(listed[a].charCodeAt(0)+1);
		} else {
			shifted.push(97);
		}
	}

	//console.log(shifted);

	for(b=0; b<shifted.length; b++){
		newString += String.fromCharCode(shifted[b]);
	}

	//console.log(newString);
	
	return newString;

}

console.log(alphabeticShift('crazy'));