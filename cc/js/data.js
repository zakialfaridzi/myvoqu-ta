/* 
 Created on : 08-Nov-2017, 09:41:56
 Author     : Chris Muiruri @chrismuiruri_
 */
var chatz = [{
	"path": "intro",
	"messages": [{
			"text": "Assalamualaikum :)",
			"author": "ConvoJs"
		},
		{
			"text": "Ada berapa surat pada Alquran ?",
			"author": "ConvoJs"
		}
	],
	"choices": [{
			"path": "block1",
			"text": "Meh",
			"type": "input"
		},
		{
			"path": "block1",
			"text": "Meh",
			"type": "button",
			"expected": "114",
			"pathTrue": "block1-correct",
			"pathFalse": "block1-wrong"
		}
	]
}, {
	"path": "block1-correct",
	"messages": [{
		"text": "Yap, Benar !",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "block2",
		"text": "Soal selanjutnya",
		"write": false
	}],
}, {
	"path": "block1-wrong",
	"messages": [{
		"text": "Salah!",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "intro",
		"text": "Try Again",
		"write": false
	}]
}, {
	"path": "block2",
	"messages": [{
		"text": "Surat Annas adalah surat yang ke ?",
		"author": "ConvoJs"
	}],
	"choices": [{
			"path": "block2",
			"text": "Meh",
			"type": "input"
		},
		{
			"path": "block2",
			"text": "Meh",
			"type": "button",
			"expected": "113",
			"pathTrue": "block2-correct",
			"pathFalse": "block2-wrong"
		}
	]
}, {
	"path": "block2-correct",
	"messages": [{
		"text": "Fantastic! ",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "block3",
		"text": "Continue!",
		"write": false
	}]
}, {
	"path": "block2-wrong",
	"messages": [{
		"text": "Wrong Answer!",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "block2",
		"text": "Try Again",
		"write": false
	}]
}, {
	"path": "block3",
	"messages": [{
		"text": "Ada berapa ayat dari surat Al-Falaq",
		"author": "ConvoJs"
	}],
	"choices": [{
			"path": "block3",
			"text": "Meh",
			"type": "input"
		},
		{
			"path": "block3",
			"text": "Meh",
			"type": "button",
			"expected": "5",
			"pathTrue": "block3-correct",
			"pathFalse": "block3-wrong"
		}
	]
}, {
	"path": "block3-correct",
	"messages": [{
		"text": "Fantastic! ",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "block__",
		"text": "Kamu berhasil melewati semua soalnya !",
		"write": false
	}]
}, {
	"path": "block3-wrong",
	"messages": [{
		"text": "Wrong Answer!",
		"author": "ConvoJs"
	}],
	"choices": [{
		"path": "intro",
		"text": "Try Again",
		"write": false
	}]
}];
