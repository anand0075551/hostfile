<!--s
function init() {
      if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
      var $ = go.GraphObject.make;  // for conciseness in defining templates
      myDiagram =
        $(go.Diagram, "myDiagramDiv",
          {
            allowCopy: false,
            allowDelete: false,
            allowMove: false,
            initialContentAlignment: go.Spot.Center,
            initialAutoScale: go.Diagram.Uniform,
            layout:
              $(FlatTreeLayout,  // custom Layout, defined below
                { angle: 90,
                  compaction: go.TreeLayout.CompactionNone }),
            "undoManager.isEnabled": true
          });

      myDiagram.nodeTemplate =
        $(go.Node, "Vertical",
          { selectionObjectName: "BODY" },
          $(go.Panel, "Auto", { name: "BODY" },
            $(go.Shape, "RoundedRectangle",
              new go.Binding("fill"),
              new go.Binding("stroke")),
            $(go.TextBlock,
              { font: "bold 12pt Arial, sans-serif", margin: new go.Margin(4, 2, 2, 2) },
              new go.Binding("text"))
          ),
          $(go.Panel,  // this is underneath the "BODY"
            { height: 15 },  // always this height, even if the TreeExpanderButton is not visible
            $("TreeExpanderButton")
          )
        );

      myDiagram.linkTemplate =
        $(go.Link,
          $(go.Shape, { strokeWidth: 1.5 }));

      // set up the nodeDataArray, describing each part of the sentence
      var nodeDataArray = [
        { key: 1, text: "Sentence", fill: "#f68c06", stroke: "#4d90fe" },
        { key: 2, text: "NP", fill: "#f68c06", stroke: "#4d90fe", parent: 1 },
        { key: 3, text: "DT", fill: "#ccc", stroke: "#4d90fe", parent: 2 },
        { key: 4, text: "A", fill: "#f8f8f8", stroke: "#4d90fe", parent: 3 },
        { key: 5, text: "JJ", fill: "#ccc", stroke: "#4d90fe", parent: 2 },
        { key: 6, text: "rare", fill: "#f8f8f8", stroke: "#4d90fe", parent: 5 },
        { key: 7, text: "JJ", fill: "#ccc", stroke: "#4d90fe", parent: 2 },
        { key: 8, text: "black", fill: "#f8f8f8", stroke: "#4d90fe", parent: 7 },
        { key: 9, text: "NN", fill: "#ccc", stroke: "#4d90fe", parent: 2 },
        { key: 10, text: "squirrel", fill: "#f8f8f8", stroke: "#4d90fe", parent: 9 },
        { key: 11, text: "VP", fill: "#f68c06", stroke: "#4d90fe", parent: 1 },
        { key: 12, text: "VBZ", fill: "#ccc", stroke: "#4d90fe", parent: 11 },
        { key: 13, text: "has", fill: "#f8f8f8", stroke: "#4d90fe", parent: 12 },
        { key: 14, text: "VP", fill: "#f68c06", stroke: "#4d90fe", parent: 11 },
        { key: 15, text: "VBN", fill: "#ccc", stroke: "#4d90fe", parent: 14 },
        { key: 16, text: "become", fill: "#f8f8f8", stroke: "#4d90fe", parent: 15 },
        { key: 17, text: "NP", fill: "#f68c06", stroke: "#4d90fe", parent: 14 },
        { key: 18, text: "NP", fill: "#f68c06", stroke: "#4d90fe", parent: 17 },
        { key: 19, text: "DT", fill: "#ccc", stroke: "#4d90fe", parent: 18 },
        { key: 20, text: "a", fill: "#f8f8f8", stroke: "#4d90fe", parent: 19 },
        { key: 21, text: "JJ", fill: "#ccc", stroke: "#4d90fe", parent: 18 },
        { key: 22, text: "regular", fill: "#f8f8f8", stroke: "#4d90fe", parent: 21 },
        { key: 23, text: "NN", fill: "#ccc", stroke: "#4d90fe", parent: 18 },
        { key: 24, text: "visitor", fill: "#f8f8f8", stroke: "#4d90fe", parent: 23 },
        { key: 25, text: "PP", fill: "#f68c06", stroke: "#4d90fe", parent: 17 },
        { key: 26, text: "TO", fill: "#ccc", stroke: "#4d90fe", parent: 25 },
        { key: 27, text: "to", fill: "#f8f8f8", stroke: "#4d90fe", parent: 26 },
        { key: 28, text: "NP", fill: "#f68c06", stroke: "#4d90fe", parent: 25 },
        { key: 29, text: "DT", fill: "#ccc", stroke: "#4d90fe", parent: 28 },
        { key: 30, text: "a", fill: "#f8f8f8", stroke: "#4d90fe", parent: 29 },
        { key: 31, text: "JJ", fill: "#ccc", stroke: "#4d90fe", parent: 28 },
        { key: 32, text: "suburban", fill: "#f8f8f8", stroke: "#4d90fe", parent: 31 },
        { key: 33, text: "NN", fill: "#ccc", stroke: "#4d90fe", parent: 28 },
        { key: 34, text: "garden", fill: "#f8f8f8", stroke: "#4d90fe", parent: 33 },
        { key: 35, text: ".", fill: "#ccc", stroke: "#4d90fe", parent: 1 },
        { key: 36, text: ".", fill: "#f8f8f8", stroke: "#4d90fe", parent: 35 }
      ]

      // create the Model with data for the tree, and assign to the Diagram
      myDiagram.model =
        $(go.TreeModel,
          { nodeDataArray: nodeDataArray });
    }

    // Customize the TreeLayout to position all of the leaf nodes at the same vertical Y position.
    function FlatTreeLayout() {
      go.TreeLayout.call(this);  // call base constructor
    }
    go.Diagram.inherit(FlatTreeLayout, go.TreeLayout);

    // This assumes the TreeLayout.angle is 90 -- growing downward
    /** @override */
    FlatTreeLayout.prototype.commitLayout = function() {
      go.TreeLayout.prototype.commitLayout.call(this);  // call base method first
      // find maximum Y position of all Nodes
      var y = -Infinity;
      this.network.vertexes.each(function(v) {
          y = Math.max(y, v.node.position.y);
        });
      // move down all leaf nodes to that Y position, but keeping their X position
      this.network.vertexes.each(function(v) {
          var node = v.node;
          if (node.isTreeLeaf) {
            node.position = new go.Point(node.position.x, y);
          }
        });
    };
    // end FlatTreeLayout
 --> 

<div id="sample">
  <h3>GoJS Parse Tree</h3>
  <div id="myDiagramDiv" style="border: solid 1px black; width:100%; height:500px"></div>
  <p>A <em>parse tree</em> is an ordered, rooted tree representing the structure of a sentence, broken down to parts-of-speech.</p>
  <p>
    This diagram uses a custom <a>TreeLayout</a> called <b>FlatTreeLayout</b> that places all leaf nodes at the same Y position.
    It also makes use of a <b>TreeExpanderButton</b> on the node template. See the <a href="../intro/buttons.html">Intro page on Buttons</a> for more GoJS button information.
  </p>
  <p>
    The abbreviations used in this diagram are:
    </p><ul>
      <li><b>NP</b>, a noun phrase</li>
      <li><b>VP</b>, a verb phrase</li>
      <li><b>PP</b>, a prepositional phrase</li>
      <li><b>DT</b>, a determiner</li>
      <li><b>JJ</b>, an adjective</li>
      <li><b>NN</b>, a common noun</li>
      <li><b>VBZ</b>, a third person singular present verb</li>
      <li><b>VBN</b>, a past participle verb</li>
    </ul>
  <p></p>
</div>
