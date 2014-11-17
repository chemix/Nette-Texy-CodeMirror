$(function(){

    var codeEditor = $('#code');
    if (codeEditor[0]) {
        console.log('init CodeMirror');

        var mac = CodeMirror.keyMap["default"] == CodeMirror.keyMap.macDefault;
        var ctrl = mac ? "Cmd-" : "Ctrl-";

        var map = {}
        map[ctrl + "B"] = function(cm) { wrap(cm, '**'); };
        map[ctrl + "I"] = function (cm) { wrap(cm, '//'); };

        function wrap(cm, mark) {
            var selection = cm.doc.getSelection();
            if (selection) {
                cm.doc.replaceSelection(mark + selection + mark);
            } else {
                var cur = cm.doc.getCursor();
                cm.doc.replaceRange(mark + mark, cur);
                cm.doc.setCursor(cur.line, cur.ch + 1);
            }
        }

        var editor = CodeMirror.fromTextArea(codeEditor[0], {
            theme: "monokai"
        });

        var options = {
            uploadUrl: basePath + '/Homepage/save-image',
            urlText: "\n[*{filename}*]\n"
        }

        inlineAttachment.editors.codemirror4.attach(editor, options);

        editor.addKeyMap(map);
    }

});
