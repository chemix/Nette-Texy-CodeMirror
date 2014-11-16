$(function(){

    var codeEditor = $('#code');
    if (codeEditor[0]) {
        console.log('init CodeMirror');

        var map = {
            "Cmd-B": function (cm) {
                var selection = cm.doc.getSelection();
                if (selection) {
                    cm.doc.replaceSelection('**' + selection + '**');
                } else {
                    var cur = cm.doc.getCursor();
                    cm.doc.replaceRange('****', cur);
                    cm.doc.setCursor(cur.line, cur.ch + 2);
                }
            },
            "Cmd-I": function (cm) {
                var selection = cm.doc.getSelection();
                if (selection) {
                    cm.doc.replaceSelection('*' + selection + '*');
                } else {
                    var cur = cm.doc.getCursor();
                    cm.doc.replaceRange('**', cur);
                    cm.doc.setCursor(cur.line, cur.ch + 1);
                }
            },
            "Cmd-S": function (cm) {
                // todo... ajax save
            }
        };

        var editor = CodeMirror.fromTextArea(codeEditor[0], {
            theme: "monokai"
            //, viewportMargin: "Infinity"
        });

        var options = {
            uploadUrl: basePath + '/Homepage/save-image',
            urlText: "\n[*{filename}*]\n"
        }

        inlineAttachment.editors.codemirror4.attach(editor, options);

        editor.addKeyMap(map);
    }

});
